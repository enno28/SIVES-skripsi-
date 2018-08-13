<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalUjian extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    protected $table 		= 'jadwal_ujian';
    public 	  $timestamps 	= false;
    protected $fillable 	= ['id_jadwal','id_mk','tanggal_ujian','waktu_mulai','waktu_selesai'];
    protected $primaryKey   = 'id_jadwal';

    //Hubungan one to one mata kuliah kuliah dengan jadwal ujian
    //penjelasan : satu mata kuliah pasti memiliki satu jadwal ujian
    public  function mata_kuliah(){
        return $this->hasOne('App\MataKuliah','id_mk','id_mk');
    }
}
