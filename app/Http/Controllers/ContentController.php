<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Place;
use App\Models\Visit;
use Illuminate\Support\Facades\Http;

class ContentController extends Controller
{
    public function showLogin()
    {
        if (session()->has('user_id')) {
            return redirect('/home');
        }

        return view('login');
    }

    public function showRegister()
    {
        if (session()->has('user_id')) {
            return redirect('/profile');
        }

        return view('register');
    }

    public function showLocations()
    {
        return view('locations');
    }

    public function showLocationID($id)
    {
        $place = Place::find($id);
        if(!$place){return redirect('/luoghi');}
        return view('locationPage')
        ->with('nome', $place->name)
        ->with('descrizione', $place->description)
        ->with('id', $id);
    }

    public function showProfileID($id = false)
    {

        if(!$id){
            $id = session('user_id');
        }

        $user = User::find($id);

        if(!$user){
            return redirect('/home');
        }

        return view('profile')
        ->with('nome', $user->nickname)
        ->with('id', $user->id);
    }

    public function makeVisit($placeID){

        $location = Place::find($placeID);

        if(!$location){
            return null;
        }

        if(!session('user_id', false)){
            return $location->visits()->count();
        }

        $check = Visit::where('user_id', session('user_id'))->where('place_id', $placeID)->delete();

        if($check > 0){
        }else{
            $visit = new Visit;

            $visit->user_id = session('user_id');
            $visit->place_id = $placeID;

            $visit->save();
        }

        return $location->visits()->count();
    }
}