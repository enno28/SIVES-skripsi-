<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    protected $table 		= 'mata_kuliah';
    public 	  $timestamps 	= false;
    protected $fillable 	= ['id_mk','kode_mk','nama_mk','bobot_sks','koordinator','status_mk','status_unggah'];
    protected $primaryKey 	= 'id_mk';

    //Hubungan one to many mata kuliah dengan periode
    public  function periode(){
        return $this->hasMany('App\Periode','id_mk');
    }

     //Hubungan one to many mata kuliah dengan peran
    public  function peran(){
        return $this->hasMany('App\Peran','id_mk');
    }

    //Hubungan one to one mata kuliah dengan user 
    //penjelasan: (pada 1 mata kuliah pasti ada koordinator (user) 1 juga)
    public function users(){
        return $this->belongsToMany('App\User','peran','id_mk','id_user')
        ->withPivot('peran','sesi_verif','tahun1','tahun2');
    } 	
   	public  function user(){
        return $this->belongsTo('App\User','koordinator','id');
    }

    //Hubungan one to many mata kuliah dengan verifikasi
    public  function verifikasi(){
        return $this->hasMany('App\Verifikasi','id_mk','id_mk');
    }
    
}
