<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JadwalUjian;
use App\User;
use App\MataKuliah;
use App\Konfigurasi;
use App\Verifikasi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home_admin()
    {
        $jadwal_ujian   = JadwalUjian::get();
        $mata_kuliah    = MataKuliah::count();
        $dosen          = User::count();
        $verifikasi     = Verifikasi::count();
        $jumlah_jadwal  = JadwalUjian::count();
        $konfigurasi    = konfigurasi::orderBy('id_konfigurasi','desc')->first();
        return view('admin/home_admin',compact('jadwal_ujian','mata_kuliah','dosen','jumlah_jadwal','konfigurasi','verifikasi'));
    }

    public function home_verifikator()
    {
        $jadwal_ujian   = JadwalUjian::get();
        $mata_kuliah    = MataKuliah::count();
        $dosen          = User::count();
        $verifikasi     = Verifikasi::count();
        $jumlah_jadwal  = JadwalUjian::count();
        $konfigurasi    = konfigurasi::orderBy('id_konfigurasi','desc')->first();
        return view('verifikator/home_verifikator',compact('jadwal_ujian','mata_kuliah','dosen','jumlah_jadwal','konfigurasi','verifikasi'));
    }

    public function home_pengajar()
    {
        $jadwal_ujian   = JadwalUjian::get();
        $mata_kuliah    = MataKuliah::count();
        $dosen          = User::count();
        $jumlah_jadwal  = JadwalUjian::count();
        $konfigurasi    = konfigurasi::orderBy('id_konfigurasi','desc')->first();
        return view('pengajar/home_pengajar',compact('jadwal_ujian','mata_kuliah','dosen','jumlah_jadwal','konfigurasi'));
    }

}