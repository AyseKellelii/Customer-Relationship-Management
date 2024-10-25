<?php

namespace App\Models;

use App\Http\Controllers\HastaKayitController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TakipTuru extends Model
{
    use HasFactory;

    protected $table='takip_turu';

    protected $primaryKey = 'kod';
    public $incrementing = false;
    protected $keyType = 'number';

    protected $fillable= ['kod','takip_turu'];


    public $timestamps = false;

    public function hastaKayit()
    {
        return $this->hasMany(HastaKayit::class, 'takip_turu', 'kod');
    }
}
