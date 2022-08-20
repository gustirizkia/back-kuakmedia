<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->q;

        $data = User::when($q, function($query)use($q){
            return $query->where('name', "LIKE", "%$q%")->orWhere('email', 'LIKE', "%$q%");
        })->where('roles', 'admin')
        ->orderBy('id', 'desc')->paginate(12);

        $data->appends(['q' => $q]);

        return view('pages.admin.index', [
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
        return view('pages.admin.add');
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:5',
        ]);

        $password = Hash::make($request->password);
        $data['password'] = $password;
        $data['roles'] = 'admin';

        $user = User::create($data);

        return redirect()->route('user.index')->with('success', 'Berhasil tambah data admin');
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
        $data = User::find($id);

        return view('pages.admin.edit', [
            'item' => $data
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

        if($request->password){

            if(strlen($request->password) < 5){
                return redirect()->back()->with('error', 'password minimal 5 karakter');
            }
            $password = Hash::make($request->password);
            $data['password'] = $password;
        }

        $update = User::where('id', $id)->update($data);

        return redirect()->route('user.index')->with('success', 'Berhasil update admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::where('id', $id)->delete();

        return redirect()->back()->with('success', 'berhasil hapus data');
    }
}
