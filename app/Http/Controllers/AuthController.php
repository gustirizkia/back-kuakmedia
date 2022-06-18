<?php

namespace App\Http\Controllers;

use App\Models\LikeUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }

        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        $credential = $request->only('email', 'password');
        $token = JWTAuth::attempt($credential);

        return response()->json(['token' => $token, 'user' => $user], 200);
    }

    public function login(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'email|exists:users,email|required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $credential = $request->only('email', 'password');
        $token = JWTAuth::attempt($credential);

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email atau password anda salah'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'status' => 'success',
            'data' => $user,
            'token' => $token
        ]);

    }

    public function MyLike(){
        $data = LikeUser::where('user_id', auth()->user()->id)->with('artikel')->get();

        return response()->json([
            'data' => $data
        ]);
    }

}
