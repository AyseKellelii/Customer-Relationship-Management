<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
    protected $table = 'login'; // Tablo adı
    protected $primaryKey = null; // Birincil anahtar yoksa
    public $incrementing = false; // Birincil anahtar otomatik artan değilse

    protected $fillable = [ 'loginame', 'l_pass'];

    public function getAuthPassword()
    {
        return $this->l_pass; // MD5 hash'lenmiş şifreyi döndür
    }
}
