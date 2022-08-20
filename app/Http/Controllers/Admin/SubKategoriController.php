<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SubKategoriController extends Controller
{
    public function destory($id){
        $data = Category::find($id)->update([
            'sub_judul' => null
        ]);

        return redirect()->route('kategori.index')->with('success', 'Berhasil hapus sub kategori');
    }

    public function tambah($id){
        $data = Category::find($id);

        return view('pages.kategori.create', [
            'item' => $data
        ]);
    }
}
