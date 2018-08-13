<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRolePengajar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $perans = \Auth::user()->peran;
        $cek = 0;
        foreach ($perans as $key => $peran) {
            if($peran->peran == "Verifikator"){
                $cek=1;
            }
        }

         if($cek == 0) { 
            return $next($request);
        }

        return redirect()->guest('/');
    }
}
