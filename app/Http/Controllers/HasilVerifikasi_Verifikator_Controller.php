<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Peran;
use App\MataKuliah;
use App\VersiSoal;
use App\konfigurasi;
use App\Verifikasi;
use App\Berkas;
use Codedge\Fpdf\Fpdf\Fpdf;
use File;
use Auth;

class HasilVerifikasi_Verifikator_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $konfigurasi = Konfigurasi::orderBy('id_konfigurasi','desc')->first();
        $id = Auth::user()->id;
        $user=Auth::user();
        $matkul=$user->mata_kuliah->unique('id_mk');
        $dosen = Peran::where('id_user',$id)
                    ->where('peran','Pengajar')
                    ->get();
        $pending =0;
        $revisi  =0;
        $success =0;
        foreach( $dosen as $key => $unggah){
            foreach($unggah->mata_kuliah->verifikasi as $soal){
            if($soal->status_verif =='0'){
                $pending++;
            }elseif ($soal->status_verif =='1'){
                $revisi++;
            }elseif ($soal->status_verif =='2'){
                $success++;
            }
        }
    }

        return view('verifikator/hasil_verifikasi_verifikator',compact('dosen','matkul','pending','revisi','success','konfigurasi'));
    }

    public function download(Request $request){
        return response()->download(public_path().'/'.$request->file);

    }

    public function downloadzip(Request $request)
    {
        File::deleteDirectory(public_path('zip'));
        $mk = MataKuliah::find($request->bap);
        
        $soal = $request->file;
        
        $bap = Berkas::where('id_mk',$request->bap)->where('id_tipe_berkas','3')
               ->orderBy('id_berkas','desc')->first();
        $kontrak_kuliah = Berkas::where('id_mk',$request->bap)->where('id_tipe_berkas','2')
               ->orderBy('id_berkas','desc')->first();
        $tgl = date("Y-m-d-H-i-s");
        $zip = \Zipper::make(public_path('zip/'.$mk->nama_mk.'.zip'));
        if(isset($bap->file)){
            $zip->add(public_path($bap->file));
        }
        if(isset($kontrak_kuliah->file)){
            $zip->add(public_path($kontrak_kuliah->file));
        }
        if(isset($soal)){
            $zip->add(public_path($soal));
        }
        $zip->close();

        return response()->download(public_path('zip/'.$mk->nama_mk.'.zip'));
    }

    public function pdf2($id) {
        // ambil dulu

        $versi_soal = VersiSoal::where('id_versi',$id)->first(); 
        ;
        $fpdf = new Fpdf;
        $fpdf->AddPage();
        $fpdf->Image(public_path().'/logo.png', 6, 6, 27, 27);
        $fpdf->SetMargins(2,3,2);
        // Title
        $fpdf->SetFont('Times', '', 12);
        $fpdf->Cell(310, 10, 'POB/KOM-PP/05/FRM-02-01', 0, 1, 'C');
        $fpdf->SetFont('Times', 'B', 16);
        $fpdf->Cell(210, 5, 'INSTITUT PERTANIAN BOGOR', 0, 1, 'C');
        // Line break
        $fpdf->SetFont('Times', 'B', 14);
        $fpdf->Cell(210, 5, 'FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM', 0, 1, 'C');
        // Line break
        $fpdf->SetFont('Times', 'B', 14);
        $fpdf->Cell(210, 5, 'DEPARTEMEN ILMU KOMPUTER', 0, 1, 'C');
        // Line break
        $fpdf->SetFont('Times', '', 11);
        $fpdf->Cell(210, 5, 'Jl. Meranti Wing 20 Level V, Darmaga 16680 Bogor, Telp/Fax (0251) 8625584', 0, 1, 'C');
        // Line break
        $fpdf->SetFont('Times', '', 11);
        $fpdf->Cell(210, 5, 'e-mail: ilkom@ipb.ac.id', 0, 1, 'C');
        // Line break
        $fpdf->SetLineWidth(0.5);
        $fpdf->Line(5, 47, 205, 47);
        $fpdf->Line(5, 48, 205, 48);
        $fpdf->Ln(20);
        //form verifikasi soal ujian
        $fpdf->SetFont('Times', 'B', 16);
        $fpdf->setY(45);
        $fpdf->Cell(210, 20, 'FORM VERIFIKASI SOAL UJIAN', 0, 1, 'C');

        $y = 60;
        $fpdf->SetFont('Times', '', 12);
        $fpdf->SetXY(20, $y);
        $fpdf->Cell(210, 2, 'Semester', 0, 1, '');
        $fpdf->SetXY(60, $y);
        $fpdf->Cell(210, 2, ': '.$versi_soal->verifikasi->konfigurasi->periode, 0, 1, '');

        $fpdf->SetXY(140, $y);
        $fpdf->Cell(210, 2, 'Tahun Ajaran', 0, 1, '');
        $fpdf->SetXY(170, $y);
        $fpdf->Cell(210, 2, ': '.$versi_soal->verifikasi->konfigurasi->tahun1.'/'.$versi_soal->verifikasi->konfigurasi->tahun2, 0, 1, '');

        $y+=7;
        $fpdf->SetXY(20, $y);
        $fpdf->Cell(210, 2, 'Mata Kuliah', 0, 1, '');
        $fpdf->SetXY(60, $y);
        $fpdf->Cell(210, 2, ': '.$versi_soal->verifikasi->mata_kuliah->nama_mk, 0, 1, '');

        $y+=7;
        $fpdf->SetXY(20, $y);
        $fpdf->Cell(210, 2, 'Kode Mata Kuliah', 0, 1, '');
        $fpdf->SetXY(60, $y);
        $fpdf->Cell(210, 2, ': '.$versi_soal->verifikasi->mata_kuliah->kode_mk, 0, 1, '');

        $y+=7;
        $fpdf->SetXY(20, $y);
        $fpdf->Cell(210, 2, 'Jenis Ujian', 0, 1, '');
        $fpdf->SetXY(60, $y);
        $fpdf->Cell(210, 2, ': '.$versi_soal->verifikasi->jenis_ujian, 0, 1, '');

        $y+=7;
        $fpdf->SetXY(20, $y);
        $fpdf->Cell(210, 2, 'Koordinator', 0, 1, '');
        $fpdf->SetXY(60, $y);
        $fpdf->Cell(210, 2, ': '.$versi_soal->verifikasi->mata_kuliah->user->name, 0, 1, '');

        $y+=7;
        $fpdf->SetXY(20, $y);
        $fpdf->Cell(210, 2, 'Nama Asisten', 0, 1, '');
        $fpdf->SetXY(60, $y);
        $fpdf->Cell(210, 2, ':', 0, 1, '');

        $y+=7;
        $fpdf->SetXY(20, $y);
        $fpdf->Cell(210, 2, 'Verifikator', 0, 1, '');
        $fpdf->SetXY(60, $y);
        $fpdf->Cell(210, 2, ': '.$versi_soal->verifikasi->user_verif->name, 0, 1, '');

        $y+=7;
        $fpdf->SetXY(20, $y);
        $fpdf->Cell(210, 2, 'Catatan Verifikasi', 0, 1, '');
        $fpdf->SetXY(60, $y);
        $fpdf->Cell(210, 2, ':', 0, 1, '');

        $y+=7;
        $fpdf->SetXY(20, $y);
        $fpdf->Cell(210, 2, '1. Kesesuaian BAP dan', 0, 1, '');
        $fpdf->SetXY(105, $y);
        $fpdf->Cell(210, 2, ':', 0, 1, '');

        if($versi_soal->form_verif->kesesuaian_lo == 'Sesuai'){
            $fpdf->SetXY(110, $y);
            $fpdf->Cell(210, 2, '[ X ] Sesuai', 0, 1, '');
            $fpdf->SetXY(150, $y);
            $fpdf->Cell(210, 2, '[     ] Tidak Sesuai', 0, 1, '');
        }
        else{
            $fpdf->SetXY(110, $y);
            $fpdf->Cell(210, 2, '[     ] Sesuai', 0, 1, '');  
            $fpdf->SetXY(150, $y);
            $fpdf->Cell(210, 2, '[ X ] Tidak Sesuai', 0, 1, '');
        }

        $y+=5;
        $fpdf->SetXY(24, $y);
        $fpdf->Cell(210, 2, 'GBPP/SAP', 0, 1, '');

        $y+=5;
        $fpdf->SetXY(24, $y);
        $fpdf->Cell(210, 2, 'Keterangan : ', 0, 1, '');
        $fpdf->SetXY(50, $y);
        $fpdf->Cell(210, 2, $versi_soal->form_verif->penjelasan_lo, 0, 1, '');
        

        $fpdf->SetXY(20, 133);
        $fpdf->Cell(210, 2, '2. Tipe Soal', 0, 1, '');
        $fpdf->SetXY(105, 133);
        $fpdf->Cell(210, 2, ':', 0, 1, '');
        $fpdf->SetXY(110, 133);
        $fpdf->Cell(210, 2, '[ X ] Pilihan Ganda', 0, 1, '');
        $fpdf->SetXY(150, 133);
        $fpdf->Cell(210, 2, '[     ] Matching', 0, 1, '');
        $fpdf->SetXY(110, 138);
        $fpdf->Cell(210, 2, '[     ] B/S', 0, 1, '');
        $fpdf->SetXY(150, 138);
        $fpdf->Cell(210, 2, '[     ] Essay', 0, 1, '');
        $fpdf->SetXY(110, 143);
        $fpdf->Cell(210, 2, '[     ] Isian', 0, 1, '');

        $fpdf->SetXY(20, 150);
        $fpdf->Cell(210, 2, '3. Butir soal mewakili materi', 0, 1, '');
        $fpdf->SetXY(105, 150);
        $fpdf->Cell(210, 2, ':', 0, 1, '');
        $fpdf->SetXY(24, 155);
        $fpdf->Cell(210, 2, 'mata kuliah', 0, 1, '');
        $fpdf->SetXY(110, 150);
        if($versi_soal->form_verif->kesesuaian_bs == 'Mewakili'){
            $fpdf->Cell(210, 2, '[ X ] Mewakili', 0, 1, '');
            $fpdf->SetXY(150, 150);
            $fpdf->Cell(210, 2, '[     ] Tidak Mewakili', 0, 1, '');
            $fpdf->SetXY(24, 160);
        }
        else{
            $fpdf->Cell(210, 2, '[     ] Mewakili', 0, 1, '');
            $fpdf->SetXY(150, 150);
            $fpdf->Cell(210, 2, '[ X ] Tidak Mewakili', 0, 1, '');
            $fpdf->SetXY(24, 160);
        }
        $fpdf->Cell(210, 2, 'Keterangan : '.$versi_soal->form_verif->penjelasan_bs, 0, 1, '');

        $fpdf->SetXY(20, 167);
        $fpdf->Cell(210, 2, '4. Estimasi waktu pengerjaan soal', 0, 1, '');
        $fpdf->SetXY(105, 167);
        $fpdf->Cell(210, 2, ':', 0, 1, '');
        if($versi_soal->form_verif->estimasi_wkt == 'Cukup'){
            $fpdf->SetXY(110, 167);
            $fpdf->Cell(210, 2, '[ X ] Cukup', 0, 1, '');
            $fpdf->SetXY(150, 167);
            $fpdf->Cell(210, 2, '[     ] Tidak Cukup', 0, 1, '');
        }
        else{
            $fpdf->SetXY(110, 167);
            $fpdf->Cell(210, 2, '[     ] Cukup', 0, 1, '');
            $fpdf->SetXY(150, 167);
            $fpdf->Cell(210, 2, '[ X ] Tidak Cukup', 0, 1, '');
        }

        $fpdf->SetXY(20, 174);
        $fpdf->Cell(210, 2, '5. Hasil verifikasi', 0, 1, '');
        $fpdf->SetXY(105, 174);
        $fpdf->Cell(210, 2, ':', 0, 1, '');
        if($versi_soal->form_verif->status == 'Sesuai'){
            $fpdf->SetXY(110, 174);
            $fpdf->Cell(210, 2, '[ X ] Diproses untuk', 0, 1, '');
            $fpdf->SetXY(119, 179);
            $fpdf->Cell(210, 2, 'diperbanyak', 0, 1, '');
            $fpdf->SetXY(150, 174);
            $fpdf->Cell(210, 2, '[     ] Revisi', 0, 1, '');
        }
        else{
            $fpdf->SetXY(110, 174);
            $fpdf->Cell(210, 2, '[  ] Diproses untuk', 0, 1, '');
            $fpdf->SetXY(119, 179);
            $fpdf->Cell(210, 2, 'diperbanyak', 0, 1, '');
            $fpdf->SetXY(150, 174);
            $fpdf->Cell(210, 2, '[ X ] Revisi', 0, 1, '');
        }
        $fpdf->SetXY(110, 190);
        $bulan = array (1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
        $unix = strtotime($versi_soal->form_verif->tanggal_verif);
        $tanggalnya = date("j",$unix);
        $bulannya = date("n", $unix);
        $bulannya = $bulan[$bulannya];
        $tahunnya = date("Y", $unix);
        $fpdf->Cell(210, 2, 'Bogor, '.$tanggalnya.' '.$bulannya.' '.$tahunnya, 0, 1, '');

        $fpdf->SetXY(110, 215);
        $fpdf->Cell(210, 2, '('.$versi_soal->verifikasi->user_verif->name.')', 0, 1, '');

        $fpdf->SetLineWidth(0.25);
        $fpdf->Line(110, 220, 170, 220);

        $fpdf->SetXY(110, 223);
        $fpdf->Cell(210, 2, 'NIP. '.$versi_soal->verifikasi->user_verif->nip, 0, 1, '');

        $fpdf->SetFont('Times', '', 10);
        $fpdf->SetXY(20, 230);
        $fpdf->Cell(210, 2, '1) Bubuhkan tanda X pada salah satu pilihan', 0, 1, '');

        $fpdf->SetXY(20, 235);
        $fpdf->Cell(210, 2, '*) Coret yang tidak perlu', 0, 1, '');
      

        $fpdf->Output();
        
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
        //
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
