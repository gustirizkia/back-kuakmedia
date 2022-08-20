<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenulisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->q;
        $data = User::withCount('artikel', 'pengikut')
        ->when($q, function($query)use($q){
            return $query->where('name', "LIKE", "%$q%")->orWhere('email', "LIKE", "%$q%");
        })
        ->orderBy('id', 'desc')
        ->paginate(12);

        return view('pages.penulis.index', [
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
        return view('pages.penulis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $image = $request->file('image')->store('penulis', 'public');
        $data['image'] = $image;
        $pass = Hash::make($request->password);
        $data['password'] = $pass;

        $user = User::create($data);

        return redirect()->route('penulis.index')->with('success', 'Berhasil tambah penulis');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('pages.penulis.edit', [
            'item' => $user
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

        if($request->image){
            $image = $request->file('image')->store('penulis', 'public');
            $data['image'] = $image;
        }

        if($request->password){
            $pass = Hash::make($request->password);
            $data['password'] = $pass;
        }

        $user = User::where('id', $id)->update($data);

        return redirect()->route('penulis.index')->with('success', 'Berhasil Update Penulis');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();

        return redirect()->route('penulis.index')->with('Berhasil hapus penulis');
    }
}
