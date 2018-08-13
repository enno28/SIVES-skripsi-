<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    protected $table 		= 'periode';
    public 	  $timestamps 	= false;
    protected $fillable 	= ['id_mk','semester'];

    public  function mata_kuliah(){
        return $this->belongsTo('App\MataKuliah','id_mk','id_mk');
    }
}
