<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\KatagoriController;
use App\Http\Controllers\Admin\PenulisController;
use App\Http\Controllers\Admin\RekomendasiController;
use App\Http\Controllers\Admin\SubKategori;
use App\Http\Controllers\Admin\SubKategoriController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    dd("ERROR");
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::prefix('admin')->middleware('admin')->group(function () {
   Route::get('/', function(){
    return view('pages.index');
   });
   Route::resource('artikel', ArtikelController::class);
   Route::resource('rekomendasi', RekomendasiController::class);
   Route::resource('penulis', PenulisController::class);
   Route::resource('kategori', KatagoriController::class);
   Route::resource('kategori-sub', SubKategori::class);
   Route::resource('user', AdminController::class);

   Route::get('kategori/delete/{id}/sub', [SubKategoriController::class, 'destory'])->name('delete-sub');
   Route::get('kategori/tambah/{id}/sub', [SubKategoriController::class, 'tambah'])->name('tambah-sub');
});

Route::get('tester', function(){
    return "OK";
})->middleware('admin');
