<?php

namespace App\Http\Controllers;

use App\Models\Kimlik;
use Illuminate\Http\Request;

class KimlikController extends Controller
{
    public function index()
    {
        $kimlikler = Kimlik::all(); // Kimlik tablosundaki tüm verileri al
        return view('deneme.kimlik', compact('kimlikler')); // Veriyi view'e gönder
    }
}
