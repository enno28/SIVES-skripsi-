<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VersiSoal extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    protected $table 		= 'versi_soal';
    public 	  $timestamps 	= false;
    protected $fillable 	= ['id_versi','id_verifikasi','id_user','file','status_versi','tanggal_unggah'];
    protected $primaryKey 	= 'id_versi';

    public function verifikasi(){
    	return $this->belongsTo('App\Verifikasi','id_verifikasi','id_verifikasi');
    }

    public  function user(){
        return $this->belongsTo('App\User','id_user','id');
    }

    public function form_verif(){
    	return $this->belongsTo('App\FormVerif','id_versi','id_versi');
    }
}
