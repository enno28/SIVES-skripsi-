<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstTipe extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    protected $table 		= 'mst_tipe';
    public 	  $timestamps 	= false;
    protected $fillable 	= ['id_tipe','nama_tipe'];
    protected $primaryKey 	= 'id_tipe';

    public  function form_verif(){
        return $this->belongsToMany('App\FormVerif','tipe_soal','id_tipe','id_form');
    }
}
