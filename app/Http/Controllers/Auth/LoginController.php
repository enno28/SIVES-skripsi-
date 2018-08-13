<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Peran;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo(){
        if ( \Auth::user()->role == 1 )
        {
          return 'home_admin';
        }
        else
        {
       
            $perans = \Auth::user()->peran;
            $cek = 0;
            foreach ($perans as $key => $peran) {
                if($peran->peran == "Verifikator"){
                    $cek=1;
                }
            }
          if($cek == 1)  
            return 'home_verifikator';
          else
            return 'home_pengajar';
        }
      }

    public function loginLDAP(Request $req)
    {
      try {
      $client = new Client();
          $res = $client->request('POST', 'https://api.ipb.ac.id/v1/Authentication/LoginMahasiswa', [
             'headers' => ['X-IPBAPI-TOKEN' => 'Bearer 3e433708-0d6c-338e-9054-fe993aed2018'],
              'json' => [
                  'Username' => $req->input('email'),
                  'Password' => $req->input('password')                            
              ]
          ]);
            $data = $res->getBody();
            $jsonData = json_decode($data, true);
            return redirect()->route('login',['username'=>$req->input('email'),'password'=>$req->input('password')]);
            dd($jsonData);
            $user = User::Where('Username',$jsonData['Username'])->first();
        
            if($user->role == 1){
              return redirect('home_admin');
            }
            
            // $this->UserMatching($jsonData);
      }
      catch (GuzzleHttp\Exception\ClientException $e) {
          $response = $e->getResponse();
          $responseBodyAsString = $response->getBody()->getContents();
          echo $response;
      }
    }

    public function UserMatching($data)
    {
      // $user = User::find('Username',$data['Username']);
      // dd($user);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
