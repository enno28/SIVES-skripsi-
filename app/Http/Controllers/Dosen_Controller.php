<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class Dosen_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosen = user::orderBy('kode','asc')->get();
        return view('admin/dosen', compact('dosen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/tambah_dosen');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dosen = User::create([
            'kode'       => $request['kode_dosen'],
            'nip'        => $request['nip'],
            'name'       => $request['nama'],
            'username'   => $request['username'],
            'email'      => $request['email'],
        ]);

        flash('Sukses! Data Berhasil Ditambahkan')->important()->success();
        return redirect('dosen');

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
        $dosen = user::where('id',$id)->first();
        return view('admin/edit_dosen', compact('dosen'));
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
        user::where('id',$id)->update([
            'kode'         => $request['kode_dosen'],
            'name'         => $request['nama'],
            'nip'          => $request['nip'],
            'email'        => $request['email'],
        ]);
       
        return redirect('dosen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        user::where('id',$id)->update([
            'status' => 0,
        ]);
        
        return redirect('dosen');
    }

    public function activate($id)
    {
        user::where('id',$id)->update([
            'status' => 1,
        ]);
        
        return redirect('dosen');
    }
}
