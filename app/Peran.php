<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peran extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    protected $table 		= 'peran';
    public 	  $timestamps 	= false;
    protected $fillable 	= ['id_peran','id_user','id_mk','peran','sesi_verif','tahun1','tahun2'];
    protected $primaryKey   = 'id_peran';

    //Hubungan one to many peran dengan user
    //penjelasan : satu user memiliki banyak peran
    public function user(){
        return $this->belongsTo('App\User','id_user','id');
    }
    public  function mata_kuliah(){
        return $this->belongsTo('App\MataKuliah','id_mk','id_mk');
    }
}
