<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dr_adi_kodu extends Model
{
    use HasFactory;
    protected $table='dradi';

    protected $fillable=['dr_kodu','adi_soyadi','bolum'];
    protected $primaryKey='dr_kodu';
    public $timestamps=false;

    public function bolum()
    {
        return $this->belongsTo(Bolum::class, 'bolum', 'bolum');
    }

    public function crmRandevular()
    {
        return $this->hasMany(CrmRandevu::class, 'dr_kodu', 'dr_kodu');
    }

}
