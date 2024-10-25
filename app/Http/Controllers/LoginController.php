<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('giris');
    }

    public function login(Request $request)
    {
        $request->validate([
            'sunucu' => 'required|string',
            'loginame' => 'required|string',
            'l_pass' => 'required|string',
        ]);

        $sunucu = $request->input('sunucu');
        $username = $request->input('loginame');
        $password = $request->input('l_pass');

        if ($sunucu !== 'orcl') {
            return redirect()->back()->withErrors(['sunucu' => 'Geçersiz sunucu adı.']);
        }

        // Şifreyi MD5 ile şifrele
        $md5Password = md5($password);

        // Kullanıcı doğrulama sorgusu
        $user = Login::where('loginame', $username)
            ->where('l_pass', $md5Password)
            ->first();


        if ($user) {
            Auth::loginUsingId($user->loginame); // Kullanıcıyı oturum açtır
            return redirect()->route('anasayfa'); // Başarılı giriş yönlendirmesi
        } else {
            return redirect()->back()->withErrors(['home' => 'Giriş bilgileri hatalı.']);
        }
    }

    public  function  logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function forgot_password()
    {
        return view('forgot_password');
    }

}


