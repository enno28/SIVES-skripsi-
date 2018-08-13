<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Konfigurasi;
use App\MataKuliah;
use App\Berkas;

class KontrakKuliah_Controller extends Controller
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
        return view('admin/berkas_kontrak_kuliah', compact('konfigurasi','mata_kuliah'));    
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
            'berkas_kontrak_kuliah' => 'mimes:pdf' 
        ]);
        $konfigurasi = Konfigurasi::orderBy('id_konfigurasi','desc')->first();
        $mata_kuliah = MataKuliah::where('id_mk',$request->input("id_mk"))->select("nama_mk")->get();

        $berkas_kontrak_kuliah = new Berkas();        
        $berkas_kontrak_kuliah->id_mk          = $request->input("id_mk");
        $berkas_kontrak_kuliah->id_tipe_berkas = 2;
        $berkas_kontrak_kuliah->tanggal_unggah = now();

        $path = 'upload/berkas_kontrak_kuliah/TA_' .$konfigurasi->tahun1.'-'.$konfigurasi->tahun2.'/'. $konfigurasi->periode.'/'.$mata_kuliah[0]->nama_mk;

            if($request->hasFile('berkas_kontrak_kuliah')){
                $filename = $request->berkas_kontrak_kuliah->getClientOriginalName();
                $request->file('berkas_kontrak_kuliah')->move($path,$filename);
                $berkas_kontrak_kuliah->nama_file = $filename;
                $berkas_kontrak_kuliah->file = $path.'/'.$filename;
            }

        $berkas_kontrak_kuliah->save();
        flash('Sukses! Data Berhasil Ditambahkan')->important()->success();
        return redirect('kontrak_kuliah');
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
