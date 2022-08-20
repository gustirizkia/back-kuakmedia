<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArtikelModel;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->q;

        $data = ArtikelModel::with('kategori', 'penulis')
        ->when($q, function($query)use($q){
            return $query->where('judul', 'LIKE', "%$q%");
        })
        ->orderBy('id', 'desc')->paginate(12);

        $data->appends(['q' => $q]);

        return view('pages.artikel.index', [
            'items' => $data,
            'q' => $request->q
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::with('artikel')->has('artikel')->orderBy('id', 'desc')->get();
        $kategori = Category::get();

        return view('pages.artikel.add', [
            'penulis' => $user,
            'kategori' => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->except(['_token']);
        $request->validate([
            'user_id' => 'required',
            'image' => 'required',
            'body' => 'required',
            'image' => 'required|image',
        ]);

        if($request->file('image')){
            $image = $request->file('image')->store('artikel/image', 'public');
            $data['image'] = env('APP_URL') . 'storage/' . $image; 
        }

        $data['user_id'] = User::where('email', $request->user_id)->first()->id;

        $insert = ArtikelModel::create($data);

        return redirect()->route('artikel.index')->with('success', 'Berhasil tambah data artikel');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ArtikelModel::with('penulis')->find($id);
        $kategori = Category::get();

        return view('pages.artikel.edit', [
            'artikel' => $data,
            'kategori' => $kategori,
            'category_id' => (int)$data->category_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);

        $data['body'] = $data['editor1'];
        unset($data['editor1']);

        $update = ArtikelModel::where('id', $id)->update($data);

        return redirect()->route('artikel.index')->with('success', 'Berhasil update artikel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ArtikelModel::where('id', $id)->delete();

        return redirect()->back()->with('success', 'berhasil hapus data');
    }
}
