<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konfigurasi extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    protected $table 		= 'konfigurasi';
    public 	  $timestamps 	= false;
    protected $fillable 	= ['id_konfigurasi','periode','tahun1','tahun2','verifikator'];
    protected $primaryKey   = 'id_konfigurasi';

    public function verifikasi(){
        return $this->hasMany('App\Verifikasi','id_konfigurasi','id_konfigurasi');
    }
}
