<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode', 'nip', 'name', 'username', 'email', 'password', 'role','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function peran(){
        return $this->hasMany('App\Peran','id_user','id');
    }

    public function versi_soal(){
        return $this->hasMany('App\VersiSoal','id_user','id');
    }    

    public function mata_kuliah(){
        return $this->belongsToMany('App\MataKuliah','peran','id_user','id_mk')
        ->withPivot('peran','sesi_verif','tahun1','tahun2');
    } 
}

