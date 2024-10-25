<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmRandevu extends Model
{
    use HasFactory;
    protected $table='crm_randevu';

    protected $fillable=['sira_no','tc_kimlik_no','dr_kodu','bolum','rnd_tarih'];

    protected $primaryKey='tc_kimlik_no';

    public $timestamps = false;

    public function hastakayit()
    {
        return $this->belongsTo(Hastakayit::class, 'sira_no', 'hasta_adsoyad');
    }
    public function doktor()
    {
        return $this->belongsTo(dr_adi_kodu::class, 'dr_kodu', 'dr_kodu');
    }

    public function bolum()
    {
        return $this->belongsTo(Bolum::class, 'bolum', 'bolum');
    }
}
