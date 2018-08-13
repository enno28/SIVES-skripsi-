<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    protected $table 		= 'berkas';
    public 	  $timestamps 	= false;
    protected $fillable 	= ['id_berkas','id_mk','id_tipe_berkas','nama_file','file','tanggal_unggah'];
    protected $primaryKey   = 'id_berkas';

    public function tipe_berkas(){
    	return $this->hasMany('App\TipeBerkas','id_tipe_berkas','id_tipe_berkas');
    }
}
