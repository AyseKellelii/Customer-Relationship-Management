<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kimlik extends Model
{
    use HasFactory;
    protected $connection = 'oracle'; // Oracle bağlantısını belirt
    protected $table = 'kimlik'; // Tablo adını belirt
}
