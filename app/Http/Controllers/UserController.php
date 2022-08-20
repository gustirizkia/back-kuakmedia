<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Komentar;
use App\Models\Pengikut;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class UserController extends Controller
{
    public function profile(){
       $data = User::find(auth()->user()->id);

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function update(Request $request){
        $data = $request->all();

        $validasi = Validator::make($data, [
            'image' => 'image|max:50240' //5 mb
        ]);
        if($validasi->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validasi->errors()
            ], 422);
        }

        if($request->image){
            $image = $request->image->store('user/profile', 'public');
            $data['image'] = $image;
        }

        $update = User::where('id', auth()->user()->id)->update($data);

        $get = User::find(auth()->user()->id);

        return response()->json([
            'status' => 'success',
            'data' => $get
        ]);
    }

    public function komen(Request $request){
        $validasi = Validator::make($request->all(), [
            'article_id' => 'required|exists:articles,id',
            'body' => 'required'
        ]);
        if ($validasi->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validasi->errors()
            ], 422);
        }

        $komen = Komentar::create([
            'user_id' => auth()->user()->id,
            'article_id' => $request->article_id,
            'body' => $request->body
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $komen
        ]);
    }

    public function likeArtikel(Request $request){
        $validasi = Validator::make($request->all(), [
            'article_id' => 'required|exists:articles,id',
        ]);
        if ($validasi->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validasi->errors()
            ], 422);
        }

        $isExists = DB::table('like_users')->where('user_id', auth()->user()->id)->where('article_id', $request->article_id)->exists();
        if ($isExists) {
            return response()->json([
                'status' => 'error',
                'message' => 'user sudah like artikel'
            ], 422);
        }

        $data = DB::table('like_users')->insertGetId([
            'user_id' => auth()->user()->id,
            'article_id' => $request->article_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil like artikel'
        ]);
    }

    public function follow(Request $request){
        $validasi = Validator::make($request->all(), [
            'penulis_id' => 'required|exists:users,id',
        ]);
        if ($validasi->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validasi->errors()
            ], 422);
        }

        $isExists = Pengikut::where('user_id', auth()->user()->id)->where('penulis_id', $request->penulis_id)->exists();
        if($isExists){
            $unfollow = Pengikut::where('user_id', auth()->user()->id)->where('penulis_id', $request->penulis_id)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'berhasil unfollow'
            ]);
        }
        
        $pengikut = Pengikut::create([
            'user_id' => auth()->user()->id,
            'penulis_id' => $request->penulis_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'berhasil follow'
        ]);
    }
}
