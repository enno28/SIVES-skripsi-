<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use File;
use App\Konfigurasi;
use App\MataKuliah;
use App\Verifikasi;
use App\FormVerif;
use App\VersiSoal;
use App\TipeSoal;



class Konfigurasi_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $konfigurasi = konfigurasi::create([
            'periode'      => $request['periode'],
            'tahun1'       => $request['tahun1'],
            'tahun2'       => $request['tahun2'],
            'verifikator'  => $request['verifikator'],
        ]);

        $mata_kuliah = MataKuliah::where('status_unggah','1')->update([
            'status_unggah'      => 0, 
        ]);

        Verifikasi::truncate();
        FormVerif::truncate();
        VersiSoal::truncate();
        TipeSoal::truncate();

        flash('Konfigurasi Berhasil Diubah')->important()->success();

        //Membuat Folder Berkas Soal (lokasi folder : public/upload)
        $path1 = 'upload/berkas_soal/TA_' . $request['tahun1'].'-'.$request['tahun2'].'/'. $request['periode'];
        $path2 = 'upload/berkas_verifikasi/TA_' . $request['tahun1'].'-'.$request['tahun2'].'/'. $request['periode'];
        if(!File::exists($path1)) {
                File::makeDirectory($path1, 0777, true, true);
                File::makeDirectory($path2, 0777, true, true);
                return redirect('konfigurasi/1/edit');
            }
            else{
                return redirect('konfigurasi/1/edit');
            }
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
    public function edit()
    {
        $konf = Konfigurasi::orderBy('id_konfigurasi','desc')->first();
        return view('admin/konfigurasi', compact('konf'));
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
        // $konfigurasi = konfigurasi::where('id_konfigurasi','10')->get();
        // $konfigurasi->periode = $request->input("periode");
        // $konfigurasi->tahun1 = $request->input("tahun1");
        // $konfigurasi->tahun2 = $request->input("tahun2");
        // $konfigurasi->verifikator = $request->input("verifikator");
        // $konfigurasi->save();

        // //update status unggah mata kuliah
        // $mata_kuliah = MataKuliah::get();
        // $mata_kuliah->status_unggah = 0;
        // $mata_kuliah->save();

        // // $verifikasi = Verifikasi::truncate();
        // // $formverif = FormVerif::truncate();
        // // $versisoal = VersiSoal::truncate();
        // // $tipesoal = TipeSoal::truncate();

        // //Membuat Folder Berkas Soal (lokasi folder : public/upload)
        // $path1 = 'upload/berkas_soal/TA_' . $request['tahun1'].'-'.$request['tahun2'].'/'. $request['periode'];
        // $path2 = 'upload/berkas_verifikasi/TA_' . $request['tahun1'].'-'.$request['tahun2'].'/'. $request['periode'];
        // if(!File::exists($path1)) {
        //         File::makeDirectory($path1, 0777, true, true);
        //         File::makeDirectory($path2, 0777, true, true);
        //         flash('Konfigurasi Berhasil Diubah')->important()->success();
        //         return redirect('konfigurasi/1/edit');
        //     }
        //     else{
        //          flash('Konfigurasi Gagal Diubah')->important()->danger();
        //         return redirect('konfigurasi/1/edit');
        //     }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}