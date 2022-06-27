<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\RekomendasiAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function list(Request $request){

        $limit = $request->limit;

        $data = Article::when($limit, function($query) use ($limit){
            return $query->limit($limit);
        })
        ->where('publish', 'yes')->with('kategori', 'penulis', 'view')
        ->select('id', 'judul', 'image', 'user_id', 'category_id', 'updated_at as tanggal_dipublish')
        ->withCount('like as jumlah_like')
        ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function detail(Request $request){
        $validasi = Validator::make($request->all(), [
            'slug' => 'required|exists:articles,slug'
        ]);

        if($validasi->fails())
        {
            return response()->json([
                'status' => 'error',
                'message' => $validasi->errors()
            ], 422);
        }

        $data = Article::with('komentar.user')->where('slug', $request->slug)->first();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function create(Request $request){
        $validasi = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|required|max:50000',
            'judul' => 'required|string',
            'body' => 'required'
        ]);
        if($validasi->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validasi->errors()
            ], 422);
        }

        $image = $request->file('image')->store('artikel/image', 'public');
        $data = $request->all();
        $data['image'] = $image;
        $data['user_id'] = auth()->user()->id;
        // $data['slug'] = Str::slug($request->judul, '-');

        $create = Article::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $create
        ], 201);
    }

    public function terbaru(Request $request, $limit = 6){

        if($request->limit){
            $limit = $request->limit;
        }

        $data = Article::orderBy('id', 'desc')
            ->with('kategori', 'penulis')
            ->select('id', 'judul', 'image', 'user_id', 'category_id', 'updated_at as tanggal_dipublish')
            ->withCount('like as jumlah_like')
            ->withSum('view as jumlah_view', 'jumlah')
            ->where('publish', 'yes')
            ->limit($limit)->get();

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
    }

    public function rekomendasi(){
        $rekomendasi = RekomendasiAdmin::orderBy('id', 'desc')->get()->pluck('article_id');

        $data = Article::whereIn('id', $rekomendasi)
            ->with('kategori', 'penulis')
            ->select('id', 'judul', 'image', 'user_id', 'category_id', 'updated_at as tanggal_dipublish')
            ->withCount('like as jumlah_like')
            ->withSum('view as jumlah_view', 'jumlah')
            ->where('publish', 'yes')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
