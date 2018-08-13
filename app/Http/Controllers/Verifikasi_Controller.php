<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Peran;
use App\MataKuliah;
use App\VersiSoal;
use App\Konfigurasi;
use App\Verifikasi;
use App\MstTipe;
use App\TipeSoal;
use App\FormVerif;
use File;
use Auth;

class Verifikasi_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$sesi = Konfigurasi::first();
        $id = \Auth::user()->id;
        $dosen = Peran::where('id_user',$id)
			        ->where('peran','Verifikator')
			        ->where('sesi_verif',$sesi->verifikator)
			        ->get();

        foreach ($dosen as $key => $value) {
            $verifikasi = Verifikasi::where('id_mk',$value->id_mk)->orderBy('id_verifikasi','desc')->first();
            if(!isset($verifikasi))
                $cek[$key] = 2;
            elseif($verifikasi->status_verif == 0)
                $cek[$key] = 0;
            else
                $cek[$key] = 1;
        }
      
        return view('verifikator/list_verifikasi', compact('dosen','cek'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_mk)
    {
        $mata_kuliah = MataKuliah::where('id_mk',$id_mk)->first();
        return view('verifikator/form_verifikasi', compact('mata_kuliah'));
    }

    public function store(Request $request)
    {
        
            $verifikasi = Verifikasi::where('id_mk',$request->id_mk)
                            ->select('id_verifikasi')->first();
            $versi_soal = VersiSoal::where('id_verifikasi',$verifikasi
                            ->id_verifikasi)->orderBy('id_versi','desc')->select('id_versi')->first();
            
            $form = new FormVerif;        
            $form->id_versi         = $versi_soal->id_versi;
            $form->kesesuaian_lo    = $request->input("kesesuaian_lo");
            $form->penjelasan_lo    = $request->input("penjelasan_lo");
            $form->kesesuaian_bs    = $request->input("kesesuaian_bs");
            $form->penjelasan_bs    = $request->input("penjelasan_bs");
            $form->estimasi_wkt     = $request->input("estimasi_wkt");
            $form->status           = $request->input("status");
            $form->tanggal          = now();
            $form->save();

            foreach ($request->tipe as $key => $value) {
                $tipe = new TipeSoal;
                $tipe->id_form      = $form->id_form;
                $tipe->id_tipe      = $value;
                $tipe->save();
            }


            if($request->status == 'Sesuai'){
                $verifikasi->status_verif = 2;
            }
            else{
                $verifikasi->status_verif = 1;
            }

            $verifikasi->save();
            
        return redirect('verifikasi');  
    }

}
