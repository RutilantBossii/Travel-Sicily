<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

    public function register(Request $request){

        $check = User::where('nickname', $request->input('nickname'))->first();

        if($check){
            return redirect('/register')
                ->with('errMsgNick', 'Questo nickname esiste già, scegline un altro');
        }

        $user = new User;

        $user->nickname = $request->input('nickname');
        $user->password = $request->input('password');
        $user->about = 'Nessuna descrizione fornita.';

        $user->save();

        session(['user_id' => $user->id]);
        return redirect('/home');
    }

    public function login(Request $request){
        $nickIn = $request->input('nickname');
        $pwdIn = $request->input('password');

        $user = User::where('nickname', $nickIn)->first();

        if(!$user){
            return redirect('/login')
            ->with('errMsgNick', 'Questo utente non esiste');
        }
        if($user->password !== $pwdIn){
            return redirect('/login')
            ->with('errMsgPwd', 'Password Errata');
        }

        session(['user_id' => $user->id]);
        return redirect('/home');
    }

    public function logout(){
        session()->flush();

        return redirect('/login');
    }

    public function deleteAccount(){
        $userID = session('user_id');
        $user = User::where('id', $userID)->first();

        if($user){
            $user->delete();
            session()->flush();
        }

        return redirect('/login/');
    }

    public function redirectToLastFM()
    {
        $apiKey = env('LASTFM_API_KEY');
        $apiSecret = env('LASTFM_API_SECRET');
        $callbackUrl = 'http://localhost:8000/callback/lastfm';
        
        $url = "https://www.last.fm/api/auth/?api_key={$apiKey}&cb={$callbackUrl}";
        
        return redirect($url);
    }

    public function lastFMCallback(Request $request){
        $apiKey = env('LASTFM_API_KEY');
        $apiSecret = env('LASTFM_API_SECRET');
        $apiToken = $request->token;
        $sigStr = "api_key".$apiKey."method"."auth.getSession"."token".$apiToken.$apiSecret;
        $apiSig = md5(utf8_encode($sigStr));

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://ws.audioscrobbler.com/2.0/?method=auth.getSession&token={$apiToken}&api_key={$apiKey}&api_sig={$apiSig}&format=json");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $userFM = json_decode($result, true);
        $lastFMKey = $userFM['session']['key'];
        $lastFMName = $userFM['session']['name'];

        $check = User::where('lastfm_username', $lastFMName)->first();

        if($check){
            session(['user_id' => $check->id]);
            return redirect('/home');
        }

        $newUser = new User;

        $newUser->lastfm_username = $lastFMName;
        $newUser->nickname = $lastFMName;
        $newUser->password = $lastFMKey;
        $newUser->about = 'Nessuna descrizione fornita.';
        $newUser->lastfm_session_key = $lastFMKey;

        $newUser->save();

        session(['user_id' => $newUser->id]);

        return redirect('/home');
    }

    public function verifyMod(){
        return User::find(session('user_id'))->moderator;
    }
}


