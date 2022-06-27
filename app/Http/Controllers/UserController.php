<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
}
