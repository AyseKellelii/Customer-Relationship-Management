<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bolum extends Model
{
    use HasFactory;
    protected $table='bolum';

    protected $fillable=['bolum','bolum_adi'];
    protected $primaryKey='bolum';

    public function doktor()
    {
        return $this->hasMany(dr_adi_kodu::class, 'bolum', 'bolum');
    }

    public function crmRandevular()
    {
        return $this->hasMany(CrmRandevu::class, 'bolum', 'bolum');
    }
}
