<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list(Request $request){
        $data  = Category::with('sub')->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
