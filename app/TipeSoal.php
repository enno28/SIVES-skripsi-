<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipeSoal extends Model
{
     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    protected $table 		= 'tipe_soal';
    public 	  $timestamps 	= false;
    protected $fillable 	= ['id_form','id_tipe'];
    
}
