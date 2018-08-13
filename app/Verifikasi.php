<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    protected $table 		= 'verifikasi';
    public 	  $timestamps 	= false;
    protected $fillable 	= ['id_verifikasi','id_konfigurasi','verifikator','id_mk','jenis_ujian','status_verif'];
    protected $primaryKey 	= 'id_verifikasi';


    public function versi_soal(){
    	return $this->hasMany('App\VersiSoal','id_verifikasi','id_verifikasi');
    }

    public function mata_kuliah(){
    	return $this->belongsTo('App\MataKuliah','id_mk','id_mk');
    }

    public function user_verif(){
        return $this->belongsTo('App\User','verifikator','id');
    }

    public function konfigurasi(){
        return $this->belongsTo('App\Konfigurasi','id_konfigurasi','id_konfigurasi');
    }

}
