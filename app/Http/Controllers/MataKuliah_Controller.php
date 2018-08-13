<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use App\MataKuliah;
use App\Periode;
use App\User;
use App\Peran;
use App\Konfigurasi;
use App\JadwalUjian;

class MataKuliah_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mata_kuliah = MataKuliah::get();
                      
        $konfigurasi = Konfigurasi::get();
        return view('admin/mata_kuliah', compact('mata_kuliah','konfigurasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datadosen = User::get();
        return view('admin/tambah_mata_kuliah',compact('datadosen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Memasukan atribut mata kuliah
        $konfigurasi = Konfigurasi::orderBy('id_konfigurasi','desc')->first();
        $mk = MataKuliah::create([
            'kode_mk'      => $request['kode_mk'],
            'nama_mk'      => $request['nama_mk'],
            'bobot_sks'    => $request['bobot_sks'],
            'koordinator'  => $request['koordinator'],
            'status_mk'    => $request['status_mk'],
        ]);

        //Memasukan semester (1 mata kuliah bisa ada di 2 semester)
        $s=$request['semester'];
        for($i=0;$i<count($s);$i++){
        Periode::create([
            'id_mk'    => $mk->id_mk,
            'semester' => $s[$i],
        ]);
        };

        //Memasukan peran tipe pengajar
        $pengajar=$request['pengajar'];
        for($i=0;$i<count($pengajar);$i++){
        Peran::create([
            'id_user'       => $pengajar[$i],
            'id_mk'         => $mk->id_mk,
            'peran'         => 'Pengajar',
            'tahun1'        => $konfigurasi->tahun1,
            'tahun2'        => $konfigurasi->tahun2,  
        ]);
        };

        //Memasukan peran tipe verifikator UTS
        $verif_uts =$request['verif_uts'];
        Peran::create([
            'id_user'       => $verif_uts,
            'id_mk'         => $mk->id_mk,
            'peran'         => 'Verifikator',
            'sesi_verif'    => 'UTS',  
            'tahun1'        => $konfigurasi->tahun1,
            'tahun2'        => $konfigurasi->tahun2,
        ]);

        //Memasukan peran tipe verifikator UAS
        $verif_uas =$request['verif_uas'];
        Peran::create([
            'id_user'       => $verif_uas,
            'id_mk'         => $mk->id_mk,
            'peran'         => 'Verifikator',
            'sesi_verif'    => 'UAS',  
            'tahun1'        => $konfigurasi->tahun1,
            'tahun2'        => $konfigurasi->tahun2,
        ]);

        flash('Sukses! Data Berhasil Ditambahkan')->important()->success();
        return redirect('mata_kuliah');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_mk)
    {
        $show_mk   = MataKuliah::where('id_mk',$id_mk)->first();
        $datadosen = user::get();
        return view('admin/edit_mata_kuliah', compact('show_mk','datadosen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_mk)
    {
        $konfigurasi = Konfigurasi::orderBy('id_konfigurasi','desc')->first();
        MataKuliah::where('id_mk',$id_mk)->update([
            'nama_mk'      => $request['nama_mk'],
            'bobot_sks'    => $request['bobot_sks'],
            'status_mk'    => $request['status_mk'],
            'koordinator'  => $request['koordinator'],
        ]);  

        //Hapus sebelum update
        Periode::where('id_mk',$id_mk)->delete();
        Peran::where('id_mk',$id_mk)->where('peran','Pengajar')->delete();

        //Memasukan semester (1 mata kuliah bisa ada di 2 semester)
        $s=$request['semester'];
        for($i=0;$i<count($s);$i++){
        Periode::create([
            'id_mk'    => $id_mk,
            'semester' => $s[$i],
        ]);
        };

        //Memasukan peran tipe pengajar
        $pengajar=$request['pengajar'];
        for($i=0;$i<count($pengajar);$i++){
        Peran::create([
            'id_user'    => $pengajar[$i],
            'id_mk'      => $id_mk,
            'peran'      => 'Pengajar',
            'tahun1'     => $konfigurasi->tahun1,
            'tahun2'     => $konfigurasi->tahun2,  
        ]);
        };

        //Update verifikator UTS
        $verif_uts =$request['verif_uts'];
        Peran::where('id_mk',$id_mk)
                ->where('peran','Verifikator')
                ->where('sesi_verif','UTS')
                ->update([
                    'id_user'  => $verif_uts,
                ]); 

        //Update verifikator UAS
        $verif_uas =$request['verif_uas'];
        Peran::where('id_mk',$id_mk)
                ->where('peran','Verifikator')
                ->where('sesi_verif','UAS')
                ->update([
                    'id_user' => $verif_uas,
                ]);

        return redirect('mata_kuliah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_mk)
    {
        MataKuliah::where('id_mk',$id_mk)->delete();        
        Periode::where('id_mk',$id_mk)->delete();
        Peran::where('id_mk',$id_mk)->delete();
        JadwalUjian::where('id_mk',$id_mk)->delete();
        flash('Data Berhasil Dihapus')->important()->success();
        return redirect('mata_kuliah');
    }

}
