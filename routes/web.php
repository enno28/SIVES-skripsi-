<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::post('/loginLDAP','Auth\LoginController@loginLDAP');
// Route::post('/login','Atuh\LoginController@login')->name('login');

Auth::routes();

//Group Route Admin
Route::group(['middleware' => ['auth','cekadmin']], function () {
    //Home Admin
    Route::get('/home_admin', 'HomeController@home_admin');

    //Dosen
    Route::resource('dosen', 'Dosen_Controller');
    Route::put('activate/{id}', 'Dosen_Controller@activate');
    
    //Mata Kuliah
     Route::resource('mata_kuliah','MataKuliah_Controller');

    //Verifikasi Admin
    Route::resource('verifikasi_admin','Verifikasi_Admin_Controller');
    Route::get('download_admin', 'Verifikasi_Admin_Controller@download_admin');
    Route::get('pdf_admin/{id}', 'Verifikasi_Admin_Controller@buatpdf');

    //Jadwal Ujian
    Route::resource('jadwal_ujian','JadwalUjian_Controller');

    //Berkas Soal
    Route::resource('berkas_soal','Berkas_Soal_Controller');

    //Berkas
    Route::resource('berkas_verifikasi','Berkas_Verifikasi_Controller');
    Route::resource('kontrak_kuliah','KontrakKuliah_Controller');
    Route::resource('bap','BAP_Controller');

    //Konfigurasi
    Route::resource('konfigurasi','Konfigurasi_Controller');

});

//Group Route Pengajar
Route::group(['middleware' => ['auth','cekpengajar']], function () {
    //Home User
    Route::get('home_pengajar', 'HomeController@home_pengajar');

    //Unggah Soal    
    Route::resource('unggah_soal','UnggahSoal_Controller',['except' => ['create']]);
    Route::get('/UnggahSoal/create/{id_mk}', 'UnggahSoal_Controller@create');

    //Hasil verifikasi
    Route::resource('hasil_verifikasi','HasilVerifikasi_Controller');
    Route::get('download1', 'HasilVerifikasi_Controller@download');
    Route::get('pdf1/{id}', 'HasilVerifikasi_Controller@buatpdf');
    Route::post('store_revisi','UnggahSoal_Controller@store_revisi');
});

//Group Route Verifikator
Route::group(['middleware' => ['auth','cekverifikator']], function () {
    //Home Verifikator
	Route::get('/home_verifikator', 'HomeController@home_verifikator');

    //Unggah Soal Halaman Verifikator
    Route::resource('unggah_soal_verifikator','UnggahSoal_Verifikator_Controller',['except' => ['create']]);
    Route::get('/UnggahSoal_Verifikator/create/{id_mk}', 'UnggahSoal_Verifikator_Controller@create');

    //Verifikasi
    Route::resource('verifikasi','Verifikasi_Controller',['except' => ['create']]);
    Route::get('verifikasi/create/{id_mk}', 'Verifikasi_Controller@create');

    //Hasil Verifikasi Halaman Verifikator
    Route::resource('hasil_verifikasi_verifikator','HasilVerifikasi_Verifikator_Controller');
    Route::get('download2', 'HasilVerifikasi_Verifikator_Controller@download');
    Route::get('pdf2/{id}', 'HasilVerifikasi_Verifikator_Controller@pdf2');
    Route::post('store_revisi_verifikator','UnggahSoal_Verifikator_Controller@store_revisi');
    Route::get('download_zip', 'HasilVerifikasi_Verifikator_Controller@downloadzip');
});

// //Group Route TU
// Route::group(['middleware' => ['auth','cektu']], function () {
//     //Home TU
//     Route::get('/home_tu', 'HomeController@home_tu');
// });


