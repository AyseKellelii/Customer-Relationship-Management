<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HastaKayit extends Model
{
    use HasFactory;
    protected $table='crm_hastakayit';
    protected $primaryKey='sira_no';
    public $incrementing = false;

    public $timestamps = false;
    protected $fillable = ['sira_no','tarih','hasta_adsoyad','takip_turu','takip_aciklamasi','sorumlu_personel'];

    public function takipTuru()
    {
        return $this->belongsTo(TakipTuru::class, 'takip_turu', 'kod');
    }
    public function aramaKayit()
    {
        return $this->belongsTo(Arama::class, 'sira_no', 'arama_notu');
    }
    public function crmRandevu()
    {
        return $this->belongsTo(CrmRandevu::class,'tc_kimlik_no','sira_no');
    }



}
