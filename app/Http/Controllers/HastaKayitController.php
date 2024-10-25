<?php

namespace App\Http\Controllers;

use App\Models\Arama;
use App\Models\CrmRandevu;
use App\Models\HastaKayit;
use App\Models\TakipTuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class HastaKayitController extends Controller
{
    public function index()
    {
        return view('hasta_kayit.index');

    }


    public function create()
    {
        return view('hasta_kayit.create');
    }

    public function storeHasta(Request $request)
    {
        // Yeni bir hasta kaydı oluşturmak için `HastaKayit` modelini kullanıyoruz.
        $hasta = new HastaKayit();

        // Oracle sequence ile otomatik olarak bir sıra numarası alıyoruz.
        $hasta->sira_no = DB::selectOne("SELECT sira_no_seq.NEXTVAL as sira_no FROM dual")->sira_no;

        // Şimdiki zamanı tarih olarak ayarla
        $hasta->tarih = now(); // Laravel'in now() fonksiyonu, şimdiki tarihi ve saati döndürür

        // Diğer alanları formdan gelen verilerle dolduruyoruz.
        $hasta->hasta_adsoyad = $request->hasta_adsoyad;
        $hasta->takip_turu = $request->takip_turu;
        $hasta->takip_aciklamasi = $request->takip_aciklamasi;
        $hasta->sorumlu_personel = $request->sorumlu_personel;

        // Kayıt işlemini gerçekleştiriyoruz.
        $hasta->save();

        // Başarılı bir işlem mesajı ile kullanıcıyı yönlendiriyoruz.
        return redirect()->route('hastakayit')->with(['success' => 'Hasta kaydı başarıyla oluşturuldu']);
    }
    public function fetch()
    {
      $hastakayit=HastaKayit::all();
        return Datatables::of($hastakayit)
            ->addColumn('sira_no',function ($data){
                return $data->sira_no;
            })
            ->addColumn('tarih',function ($data){
                return $data->tarih;
            })
            ->addColumn('hasta_adsoyad',function ($data){
                return $data->hasta_adsoyad;
            })
            ->addColumn('takip_turu',function ($data){
                return $data->takip_turu;
            })
            ->addColumn('takip_aciklamasi',function ($data){
                return $data->takip_aciklamasi;
            })
            ->addColumn('sorumlu_personel', function ($data) {
                return $data->sorumlu_personel;
            })
            ->rawColumns(['sira_no','tarih','hasta_adsoyad','takip_turu','takip_aciklamasi','sorumlu_personel'])->make(true);

    }


    public function filterData(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = HastaKayit::query();

        if ($start_date && $end_date) {
            $start_date = \Carbon\Carbon::parse($start_date)->format('Y-m-d');
            $end_date = \Carbon\Carbon::parse($end_date)->format('Y-m-d');
            $query->whereBetween('tarih', [$start_date, $end_date]);
        }

        $data = $query->get(); // Veriyi al

        return view('hasta_kayit.randevu_tarih_form', compact('data')); // Veriyi view'e gönder
    }

    // Güncelleme formunun içeriğini getiren AJAX isteği için
    public function getHastaKayit($sira_no)
    {
        // $sira_no ile kayıt bulunuyor
        $hastaKayit = HastaKayit::where('sira_no', $sira_no)->firstOrFail();

        // JSON olarak döndürülüyor
        return response()->json($hastaKayit);
    }

    // Güncelleme işlemini gerçekleştiren fonksiyon
    public function updateHastaKayit(Request $request)
    {
        // Formdan gelen veriler
        $validatedData = $request->validate([
            'sira_no' => 'required|integer',  // Mevcut bir kayıt için gerekli
            'hasta_adsoyad' => 'required|string|max:255',
            'takip_turu' => 'required|string|max:255',
            'takip_aciklamasi' => 'required|string|max:255',
            'sorumlu_personel' => 'required|string|max:255',
        ]);

        // Mevcut kaydı bulmak için sira_no kullan
        $hastaKayit = HastaKayit::where('sira_no', $validatedData['sira_no'])->first();

        if (!$hastaKayit) {
            return redirect()->back()->with('error', 'Hasta kaydı bulunamadı!');
        }

        // Verileri güncelle
        $hastaKayit->hasta_adsoyad = $validatedData['hasta_adsoyad'];
        $hastaKayit->takip_turu = $validatedData['takip_turu'];
        $hastaKayit->takip_aciklamasi = $validatedData['takip_aciklamasi'];
        $hastaKayit->sorumlu_personel = $validatedData['sorumlu_personel'];

        // Güncellenen kaydı kaydet
        $hastaKayit->save();

        // Başarı mesajı ile geri yönlendirin
        return redirect()->back()->with('success', 'Hasta kaydı başarıyla düzenlendi!');
    }



}
