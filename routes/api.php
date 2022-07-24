<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenulisController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('like-saya', [AuthController::class, 'MyLike'])->middleware('auth:api');

Route::get('profile', [UserController::class, 'profile'])->middleware('auth:api');
Route::post('profile-update', [UserController::class, 'update'])->middleware('auth:api');

Route::get('kategori', [CategoryController::class, 'list']);

Route::get('artikel', [ArticleController::class, 'list']);
Route::get('artikel/detail', [ArticleController::class, 'detail']);
Route::post('artikel/create', [ArticleController::class, 'create'])->middleware('auth:api');
Route::get('artikel/like', [LikeController::class, 'likeArticle'])->middleware('auth:api');
Route::get('artikel/terbaru', [ArticleController::class, 'terbaru']);
Route::get('artikel/rekomendasi', [ArticleController::class, 'rekomendasi']);
Route::get('artikel/saya', [ArticleController::class, 'artikelSaya'])->middleware('auth:api');
Route::get('artikel/keresahaan', [ArticleController::class, 'artikelKeresahan']);

Route::get('sekutu/terbaru', [PenulisController::class, 'sekutuTerbaru']);
Route::get('sekutu/produktif', [PenulisController::class, 'palingProduktif']);
Route::get('user/search', [PenulisController::class, 'cari']);
Route::get('sekutu/detail', [PenulisController::class, 'detailPenulis']);

Route::get('penulis/terbaru', [PenulisController::class, 'penulsiTerbaru']);
Route::get('penulis/produktif', [PenulisController::class, 'penulisProduktif']);
