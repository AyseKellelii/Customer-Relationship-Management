<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'login'; // Tablo adı LOGIN olarak ayarlandı

    // Eğer primary key (birincil anahtar) LOGINAME değilse belirtin
    protected $primaryKey = 'loginame';

    // Eğer LOGINAME otomatik artan bir anahtar değilse
    public $incrementing = false;

    // Doğru kullanıcı adı ve şifre sütunlarını belirtin
    protected $fillable = ['loginame', 'l_pass'];

    // Laravel'e hangi sütunların kimlik doğrulama için kullanılacağını söyleyin
    public function getAuthIdentifierName()
    {
        return 'loginame';
    }

    public function getAuthPassword()
    {
        return $this->l_pass;
    }
}
