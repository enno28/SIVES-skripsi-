<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipeBerkas extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    protected $table 		= 'tipe_berkas';
    public 	  $timestamps 	= false;
    protected $fillable 	= ['id_tipe_berkas','nama_tipe'];
    protected $primaryKey   = 'id_tipe_berkas';

    public function berkas(){
    	return $this->belongsTo('App\Berkas','id_tipe_berkas','id_tipe_berkas');
    }
}
