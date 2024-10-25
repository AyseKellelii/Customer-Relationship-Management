<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arama extends Model
{
    use HasFactory;

    protected $table='crm_arama_kayit';

    protected $primaryKey = 'sira_no';

    protected $fillable= ['sira_no','baslangic_tarihi','bitis_tarihi','kacinci_arama','arama_notu'];

    public function hastakayit()
    {
        return $this->belongsTo(Hastakayit::class, 'sira_no', 'sira_no');
    }

    public $timestamps = false;
}
