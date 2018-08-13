<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Peran;
use App\MataKuliah;
use App\VersiSoal;
use App\konfigurasi;
use App\Verifikasi;
use File;
use Auth;
use Mail;
use Illuminate\Mail\Mailable;

class UnggahSoal_Verifikator_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $konfigurasi = Konfigurasi::select('verifikator')->first();
        $id = \Auth::user()->id;
        $user= User::find($id);
        $mata_kuliah=array();
        $mk=$user->mata_kuliah;
        foreach($mk as $m){
            if($m->pivot->peran == 'Pengajar' and $m->status_unggah==0){
                array_push($mata_kuliah,$m);
            }
        }
        return view('verifikator/list_mengajar_verifikator', compact('mata_kuliah','konfigurasi','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create($id_mk)
    {

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
            'soal_ujian' => 'mimes:doc,docx', 
        ]);
        date_default_timezone_set('Asia/Jakarta');

            $konfigurasi = Konfigurasi::orderBy('id_konfigurasi','desc')->first();
            $verifikasi = new Verifikasi();
            $user       = Auth::user();        
            $verifikasi->id_konfigurasi = $konfigurasi->id_konfigurasi;
            $verifikasi->verifikator    = $request->input("verifikator");
            $verifikasi->id_mk          = $request->input("id_mk");
            $verifikasi->jenis_ujian    = $request->input("jenis_ujian");
            $verifikasi->save();
    
            $versi_soal = new VersiSoal();
            $versi_soal->id_verifikasi  = $verifikasi->id_verifikasi;
            $versi_soal->id_user        = $user->id;
            $versi_soal->tanggal_unggah = now();
            
            
            $konfigurasi = Konfigurasi::get();
    
            $path = 'upload/berkas_soal/TA_' .$konfigurasi[0]->tahun1.'-'.$konfigurasi[0]->tahun2.'/'. $konfigurasi[0]->periode.'/'.$request->input("nama_mk");
    
            if($request->hasFile('soal_ujian')){
                $filename = $request->soal_ujian->getClientOriginalName();
                $request->file('soal_ujian')->move($path,$filename);
                $versi_soal->nama_file = $filename;
                $versi_soal->file = $path.'/'.$filename;
            }
    
            $versi_soal->save();

            MataKuliah::where('id_mk',$request->input("id_mk"))->update(['status_unggah'  => '1',]);

            // $this->sendMail($request);
            flash('Sukses! Soal berhasil diunggah')->important()->success();
            return redirect('unggah_soal_verifikator');
    }

        public function store_revisi(Request $request)
    {
        $this -> validate($request, [
            'soal_ujian' => 'mimes:doc,docx', 
        ]);
        date_default_timezone_set('Asia/Jakarta');
    
            $user       = Auth::user();
            $verifikasi = Verifikasi::where('id_mk',$request->input("id_mk"))->first();
            $versi_soal = new VersiSoal();
            $versi_soal->id_verifikasi  = $request->input("id_verifikasi");
            $versi_soal->id_user        = $user->id;
            $versi_soal->tanggal_unggah = now();
            $konfigurasi = Konfigurasi::get();
    
           $path = 'upload/berkas_soal/TA_' .$konfigurasi[0]->tahun1.'-'.$konfigurasi[0]->tahun2.'/'. $konfigurasi[0]->periode.'/'.$request->input("nama_mk");
    
            if($request->hasFile('soal_ujian')){
                $filename = $request->soal_ujian->getClientOriginalName();
                $request->file('soal_ujian')->move($path,$filename);
                $versi_soal->nama_file = $filename;
                $versi_soal->file = $path.'/'.$filename;
            }
            $versi_soal->save();
            $verifikasi->status_verif =0;
            $verifikasi->save();

            // $this->sendMail($request);

            return redirect('hasil_verifikasi_verifikator');
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

     public function sendMail($request){

        $mk = MataKuliah::find($request->id_mk);
        $to = User::find($request->verifikator);
       
        Mail::raw('Dear Bapak/Ibu,

        Tim pengajar '.$mk->nama_mk.' telah menunggah soal ujian untuk diverifikasi. untuk detail lebih lanjut silahkan buka www.siveskom.com.
                       
        Departemen Ilmu Komputer IPB
        SIVES-KOM', function($message) use($to, $mk)
        {
            $message->from("siveskom@gmail.com", "Admin SIVES-KOM");
            $message->to($to->email);           
            $message->subject("Verifikasi Soal Ujian ".$mk->nama_mk);
        });
    }
}
