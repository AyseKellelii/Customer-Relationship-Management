<?php

use App\Http\Controllers\AramaController;
use App\Http\Controllers\BolumController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HastaKayitController;
use App\Http\Controllers\KimlikController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RandevuController;
use App\Http\Controllers\SayiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/kimlik',[KimlikController::class,'index'])->name('kimlik');

Route::prefix('/admin')->middleware('isAdmin')->group(function (){

    Route::get('/anasayfa',function (){
        return view('layout.anasayfa');  //layout.index
    })->name('anasayfa');
});


//LOGİN İŞLEMLERİ
Route::get('/',  [LoginController::class, 'showLoginForm'])->name('home');
Route::get('/cikis', [LoginController::class, 'logout'])->name('logout');
Route::post('/giris', [LoginController::class, 'login'])->name('login');
Route::get('/forgot_password',[LoginController::class, 'forgot_password'])->name('forgot_password');

//HASTAKAYIT
Route::get('/hasta_kayit',[HastaKayitController::class,'index'])->name('hastakayit');
Route::get('/hasta_kayit/fetch',[HastaKayitController::class,'fetch'])->name('hastakayit.fetch');
Route::get('/admin/anasayfa', [SayiController::class, 'index'])->name('anasayfa');


Route::get('/create_hasta',[HastaKayitController::class,'create'])->name('create_hasta');
Route::post('/post_create',[HastaKayitController::class,'storeHasta'])->name('create_add_hasta');

Route::get('/randevu/filter', [HastaKayitController::class, 'filter'])->name('randevu.filter');
Route::get('/randevu/filter/data', [HastaKayitController::class, 'filterData'])->name('randevu.filter.data');


Route::post('/hasta-kayit/update', [RandevuController::class, 'store'])->name('hasta-kayit.update');




Route::get('/arama_yap',[AramaController::class,'index'])->name('aramaYap');
Route::post('/arama/update', [AramaController::class, 'updateArama'])->name('arama.update');
// Filtreleme işlemi için route
Route::get('/arama/filter', [AramaController::class, 'filter'])->name('arama.filter');
// AJAX istekleri için route
Route::get('/arama/filtered', [AramaController::class, 'filtered'])->name('arama.filtered');


Route::get('/hasta-kayit/get/{sira_no}', [HastaKayitController::class, 'getHastaKayit'])->name('hasta-kayit.get');
Route::post('/hasta-kayit/update', [HastaKayitController::class, 'updateHastaKayit'])->name('hasta-kayit.update');

Route::get('/takip-turu-list', [HastaKayitController::class, 'list'])->name('takip_turu.list');



Route::post('/arama/store', [AramaController::class, 'store'])->name('arama.store');
Route::get('/arama/get/{sira_no}', [AramaController::class, 'getArama'])->name('arama.get');

Route::get('/randevu',[RandevuController::class, 'index'])->name('randevu');
Route::post('/randevu/store',[RandevuController::class,'store'])->name('randevu.store');
Route::get('/randevu/get/{sira_no}',[RandevuController::class,'getRandevu'])->name('randevu.get');

Route::post('randevu/update',[RandevuController::class,'update'])->name('randevu.update');


Route::get('/bolumler', [RandevuController::class, 'getBolumler']);
Route::get('/doktorlar/{bolum}', [RandevuController::class, 'getDoktorlar']);


Route::post('/randevu/fetch', [RandevuController::class, 'fetch'])->name('randevu.fetch');
