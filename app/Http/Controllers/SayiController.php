<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SayiController extends Controller
{
    public function index()
    {
        $aramaSayisi = DB::table('crm_arama_kayit')->count();
        $randevuSayisi = DB::table('crm_hastakayit')->count();

        return view('layout.anasayfa', compact('aramaSayisi', 'randevuSayisi'));
    }


}
