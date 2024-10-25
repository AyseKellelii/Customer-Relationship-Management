<?php

namespace App\Http\Controllers;

use App\Models\Bolum;
use App\Models\CrmRandevu;
use App\Models\dr_adi_kodu;
use App\Models\HastaKayit;
use Illuminate\Http\Request;

class RandevuController extends Controller
{
    public function index()
    {
        $randevular = CrmRandevu::with(['doktor.bolum', 'bolum'])->get();
        return view('randevu.index', compact('randevular'));
    }


    public function getRandevu($sira_no,$hasta_adsoyadi)
    {
        // Sıra numarasına göre kayıt bulunur
        $arama = HastaKayit::where('sira_no', $sira_no)
            ->where('hasta_adisoyadi',$hasta_adsoyadi)
            ->firstOrFail();

        // JSON olarak döndürülür
        return response()->json($arama);
    }

    public function store(Request $request)
    {
        // Arama modelini kullanıyoruz
        $rnd = new CrmRandevu();

        // Sıra No'yu al, buradaki id değeri muhtemelen formdan gelen bir id olmalı
        // Eğer bir sequence kullanılacaksa burada sıralı bir numara oluşturabilirsiniz
        $rnd->sira_no = $request->sira_no;
        $rnd->tc_kimlik_no=$request->tc_kimlik_no;

        // Formdan gelen diğer verileri al
        $rnd->bolum = $request->bolum;
        $rnd->dr_kodu=$request->dr_kodu;
        $rnd->rnd_tarih = $request->rnd_tarih;
        $rnd->adi = $request->adi;
        $rnd->soyadi = $request->soyadi;
        // Modeli kaydet
        $rnd->save();

        // Başarılı bir işlem mesajı ile JSON yanıtı döndürüyoruz
        return response()->json(['success' => 'Randevu başarıyla oluşturuldu']);
    }

    public function update(Request $request)
    {
        // Gelen form verilerini al
        $data = $request->only(['sira_no','dr_kodu', 'rnd_tarih', 'bolum']);

        // Verilerin doğruluğunu kontrol et
        $request->validate([
            'sira_no' => 'required|integer',
            'rnd_tarih' => 'required|date_format:Y-m-d H:i:s',
            'dr_kodu'=>'required|string',
            'bolum' => 'required|string',
        ]);

        // Randevu kaydını bul ve güncelle
        $randevu = CrmRandevu::where('sira_no', $data['sira_no'])->first();

        if (!$randevu) {
            return response()->json(['success' => false, 'message' => 'Randevu bulunamadı.']);
        }

        $randevu->update([
            'rnd_tarih' => $data['rnd_tarih'],
            'dr_kodu'=>$data['dr_kodu'],
            'bolum' => $data['bolum'],
        ]);

        return response()->json(['success' => true, 'message' => 'Randevu başarıyla güncellendi.']);
    }





}
