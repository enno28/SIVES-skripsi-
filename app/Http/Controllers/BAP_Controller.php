<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Konfigurasi;
use App\MataKuliah;
use App\Berkas;

class BAP_Controller extends Controller
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
        return view('admin/berkas_bap', compact('konfigurasi','mata_kuliah'));
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
        $this -> validate($request, [
            'berkas_bap' => 'mimes:pdf' 
        ]);
        $konfigurasi = Konfigurasi::orderBy('id_konfigurasi','desc')->first();
        $mata_kuliah = MataKuliah::where('id_mk',$request->input("id_mk"))->select("nama_mk")->get();

        $berkas_bap = new Berkas();        
        $berkas_bap->id_mk          = $request->input("id_mk");
        $berkas_bap->id_tipe_berkas = 3;
        $berkas_bap->tanggal_unggah = now();

        $path = 'upload/berkas_bap/TA_' .$konfigurasi->tahun1.'-'.$konfigurasi->tahun2.'/'. $konfigurasi->periode.'/'.$mata_kuliah[0]->nama_mk;

            if($request->hasFile('berkas_bap')){
                $filename = $request->berkas_bap->getClientOriginalName();
                $request->file('berkas_bap')->move($path,$filename);
                $berkas_bap->nama_file = $filename;
                $berkas_bap->file = $path.'/'.$filename;
            }

        $berkas_bap->save();
        flash('Sukses! Data Berhasil Ditambahkan')->important()->success();
        return redirect('bap');
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
        //
    }
}
