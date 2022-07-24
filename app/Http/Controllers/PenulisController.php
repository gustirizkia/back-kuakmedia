<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Article;

class PenulisController extends Controller
{
    public function sekutuTerbaru(){
      $data = DB::table('users')
      ->join("articles", 'users.id', 'articles.user_id')
      ->select('name', 'users.image as image', 'email', 'bio', DB::raw("count(user_id) as artikel_count"))
      ->groupBy('user_id')
      ->orderBy('users.id', 'desc')
      ->limit(16)
      ->get();

      return response()->json([
        'status' => 'success',
        'data' => $data
      ]);
    }

    public function penulsiTerbaru(){
      $data = User::with('artikel')->has('artikel')
        ->orderBy('id', 'desc')
        ->limit(12)
        ->get();

      return response()->json([
        'status' => 'success',
        'data' => $data
      ]);
    }
    public function penulisProduktif(){
      $data = User::withCount('artikel')
        ->has('artikel')
        ->orderBy('artikel_count', 'desc')
        ->limit(12)
        ->get();

      return response()->json([
        'status' => 'success',
        'data' => $data
      ]);
    }

    public function detailPenulis(Request $request){
      $rules = \Validator::make($request->all(), [
        'user_id' => 'required|integer|exists:users,id'
      ]);

      if($rules->fails()){
        return response()->json([
          'status' => 'error',
          'message' => $rules->errors()
        ], 422);
      }

        $penulis = User::find($request->user_id);
        $artikelSaya =  Article::where('user_id', $request->user_id)
            ->with('kategori', 'penulis')
            // ->select('id', 'judul', 'image', 'user_id', 'category_id', 'updated_at as tanggal_dipublish')
            ->withCount('like as jumlah_like')
            ->withSum('view as jumlah_view', 'jumlah')
            ->where('publish', 'yes')
            ->get();

          return response()->json([
            'status' => 'success',
            'penulis' => $penulis,
            'artikel_penulis' => $artikelSaya
          ]);
    }

    public function cari(Request $request){
      $data = User::where('name', "LIKE", "%$request->keyword%")->orWhere('email', "LIKE", "%$request->keyword%")->get();

      return response()->json([
        'status' => 'success',
        'data' => $data
      ]);
    }

    public function palingProduktif(){
      $data = User::withCount('artikel')
      ->orderBy('artikel_count', 'desc')
      // ->select('name', 'users.image as user_image')
      ->limit(16)
      ->get();

      return response()->json([
        'status' => 'success',
        'data' => $data
      ]);
    }
}
