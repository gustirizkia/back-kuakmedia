<?php

namespace App\Http\Controllers;

use App\Models\LikeUser;
use App\Models\StatistikLikeArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    public function likeArticle(Request $request){
        $validasi = Validator::make($request->all(), [
            'article_id' => 'required|exists:articles,id'
        ]);
        if($validasi->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validasi->errors()
            ], 422);
        }

        $cek = LikeUser::where('id', $request->article_id)->where('user_id', auth()->user()->id)->exists();
        if($cek){
            return response()->json([
                'status' => 'error',
                'message' => 'user sudah like artikel ini'
            ], 422);
        }

        $data= [
            'article_id' => $request->article_id,
            'user_id' => auth()->user()->id
        ];

        $insert = LikeUser::create($data);

        $statistik = StatistikLikeArticle::updateOrCreate(
                [
                    'article_id' => $request->article_id
                ],
                [
                    'article_id' => $request->article_id,
                    'count' => DB::raw('count+1')
                ]
            );

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

}
