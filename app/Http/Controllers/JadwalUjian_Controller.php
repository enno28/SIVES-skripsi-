<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\MataKuliah;
use App\JadwalUjian;

class JadwalUjian_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal_ujian = JadwalUjian::get();
        return view('admin/jadwal_ujian',compact('jadwal_ujian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mata_kuliah = MataKuliah::
        leftJoin('jadwal_ujian','jadwal_ujian.id_mk','=','mata_kuliah.id_mk')
        ->select('mata_kuliah.id_mk as mk', 'mata_kuliah.*', 'jadwal_ujian.*')
        ->where('jadwal_ujian.id_mk','=',null)
        ->get();

        return view('admin/tambah_jadwal_ujian',compact('mata_kuliah'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $ujian = JadwalUjian::create([
            'id_mk'             => $request['id_mk'],
            'tanggal_ujian'     => $request['tanggal'],
            'waktu_mulai'       => $request['waktu_mulai'],
            'waktu_selesai'     => $request['waktu_selesai'],
        ]);

        flash('Sukses! Data Berhasil Ditambahkan')->important()->success();
        return redirect('jadwal_ujian');

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
    public function edit($id_jadwal)
    {
        $jadwal_ujian = JadwalUjian::where('id_jadwal',$id_jadwal)->get();
        return view('admin/edit_ujian', compact('jadwal_ujian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_jadwal)
    {
        JadwalUjian::where('id_jadwal',$id_jadwal)->update([
            'tanggal_ujian' => $request['tanggal'],
            'waktu_mulai'   => $request['waktu_mulai'],
            'waktu_selesai' => $request['waktu_selesai'],
        ]); 
        return redirect('jadwal_ujian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_jadwal)
    {
        JadwalUjian::where('id_jadwal',$id_jadwal)->delete();        
        return redirect('jadwal_ujian');
    }
}

