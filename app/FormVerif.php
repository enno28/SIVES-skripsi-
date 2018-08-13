<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormVerif extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    protected $table 		= 'form_verifikasi';
    public 	  $timestamps 	= false;
    protected $fillable 	= ['id_form','id_versi','kesesuaian_lo','penjelasan_lo','kesesuaian_bs',
    						   'penjelasan_bs','estimasi_wkt','status','tanggal_verif'];
    protected $primaryKey   = 'id_form';

    public function versi_soal(){
        return $this->hasOne('App\VersiSoal','id_versi','id_versi');
    }

    public  function mst_tipe(){
        return $this->belongsToMany('App\MstTipe','tipe_soal','id_form','id_tipe');
    }
}
