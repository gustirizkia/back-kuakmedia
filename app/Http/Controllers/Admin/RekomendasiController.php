<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\RekomendasiAdmin;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rekomendasi = RekomendasiAdmin::orderBy('id', 'desc')->get()->pluck('article_id');
        $q = $request->q;

        $data = Article::whereIn('id', $rekomendasi)
            ->when($q, function($query){
                return $query->where('judul', 'LIKE', "%$q%");
            })
            ->with('kategori', 'penulis')
            ->withCount('like as jumlah_like')
            ->withSum('view as jumlah_view', 'jumlah')
            ->where('publish', 'yes')
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('pages.rekomendasi.index', [
            'items' => $data,
            'q' => $q
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataRekomendasi = RekomendasiAdmin::pluck('article_id');

        $data = Article::orderBy('id', 'desc')->whereNotIn('id', $dataRekomendasi)->get();

        return view('pages.rekomendasi.create', [
            'artikel' => $data
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
        $artikel = Article::where('slug', $request->slug)->first();
        $rekomendasi = RekomendasiAdmin::create([
            'article_id' => $artikel->id
        ]);

        return redirect()->route('rekomendasi.index')->with('success', 'Berhasil tambah Artikel Rekomendasi');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $data = RekomendasiAdmin::where('article_id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil hapus artikel dari daftar rekomendasi');
    }
}
