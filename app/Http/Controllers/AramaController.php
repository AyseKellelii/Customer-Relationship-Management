<?php

namespace App\Http\Controllers;

use App\Models\Arama;
use App\Models\HastaKayit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AramaController extends Controller
{
    public function ara()
    {
        return view('arama.arama_yap');
    }

    public function index()
    {
        $records = Arama::all(); // Tüm kayıtları çek
        return view('arama.arama_yap', compact('records'));
    }

    public function updateArama(Request $request)
    {
        // Mevcut bir arama kaydını bul
        $arama = Arama::find($request->id);
        if (!$arama) {
            return response()->json(['error' => 'Arama kaydı bulunamadı.'], 404);
        }

        // Başlangıç tarihi ve bitiş tarihini güncelle
        $arama->baslangic_tarihi = $request->baslangic_tarihi;
        $arama->bitis_tarihi = $request->bitis_tarihi; // Güncellenen bitiş tarihi

        // Aramanın kaçıncı olduğu bilgisi
        $arama->kacinci_arama = Arama::where('sira_no', $arama->sira_no)->count() + 1;
        $arama->arama_notu = $request->arama_notu;

        $arama->save();

        // Başarılı bir işlem mesajı ile JSON yanıtı döndürüyoruz
        return response()->json(['success' => 'Arama kaydı başarıyla güncellendi']);
    }


    public function getArama($sira_no)
    {
        // Sıra numarasına göre kayıt bulunur
        $arama = HastaKayit::where('sira_no', $sira_no)->firstOrFail();

        // JSON olarak döndürülür
        return response()->json($arama);
    }

    public function store(Request $request)
    {
        $arama = new Arama();

        // Sıra No'yu al
        $arama->sira_no = $request->id;

        // Başlangıç ve bitiş tarihlerini al
        $arama->baslangic_tarihi = $request->baslangic_tarihi;
        $arama->bitis_tarihi = $request->bitis_tarihi;

        // Aramanın kaçıncı olduğu bilgisi
        $arama->kacinci_arama = Arama::where('sira_no', $arama->sira_no)->count() + 1;

        // Arama notunu al
        $arama->arama_notu = $request->arama_notu;

        // Kaydet
        $arama->save();

        return response()->json(['success' => 'Arama kaydı başarıyla güncellendi.']);
    }


    public function filter(Request $request)
    {
        return view('arama.filter');
    }

    public function filtered(Request $request)
    {
        // Filtreleme için gerekli değer
        $kacinciArama = $request->input('kacinci_arama');

        // Eğer `kacinci_arama` 0 ise hata döndür
        if ($kacinciArama == '0') {
            return redirect()->back()->with('error', '0 değeri geçersiz.');
        }

        // Filtreleme işlemi
        $records = Arama::where('kacinci_arama', $kacinciArama)->get();

        // Data ile birlikte view'a döndür
        return view('arama.arama_yap', compact('records'));
    }
}
