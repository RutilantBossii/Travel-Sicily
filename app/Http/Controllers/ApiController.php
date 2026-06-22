<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Place;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function randomCover()
    {
        $location = Place::inrandomOrder()->first();

        if(!$location){
            return null;
        }

        return $location->img;
    }

    public function getLocations()
    {
        $locations = Place::all();

        if(!$locations){
            return null;
        }

        foreach($locations as $location){
            $location->posts = $location->posts()->count();
            $location->visits = $location->visits()->count();
        }

        return $locations;
    }

    public function getLocationStats($id)
    {
        $location = Place::find($id);

        if(!$location){
            return null;
        }

        $apiKey = env('OPENWEATHER_API_KEY');
        $lat = $location->latitude;
        $lon = $location->longitude;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$apiKey}");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        $clima = json_decode($result);

        $location->meteo = $clima->weather[0]->description;
        $location->posts = $location->posts()->count();
        $location->visits = $location->visits()->count();

        return $location;
    }

    public function getLocationsByID($id)
    {
        $location = Place::find($id);

        if(!$location){
            return null;
        }

        $location->posts = $location->posts;
        $location->visits = $location->visits;

        return $location;
    }

    public function getLocationPosts($id)
    {
        $posts = Post::where('place_id', $id)->get();

        if(!$posts){
            return null;
        }

        for($i = 0; $i < $posts->count(); $i+=1){
            $posts[$i]->usrImg = $posts[$i]->user->profile_pic;
            $posts[$i]->usrName = $posts[$i]->user->nickname;
            $posts[$i]->nLikes = $posts[$i]->likes()->count();
        }

        return $posts;
    }

    public function getPostLocation($id)
    {
        $location = Post::find($id);
        if(!$location){
            return null;
        }
        return $location->place;
    }

    public function getPostUser($id)
    {
        $user = Post::find($id)->user;

        return ["name" => $user->nickname, "usrImg" => $user->img];
    }

    public function getAllPosts()
    {
        $posts = Post::all();

        for($i = 0; $i < $posts->count(); $i+=1){
            $posts[$i]->usrImg = $posts[$i]->user->profile_pic;
            $posts[$i]->usrName = $posts[$i]->user->nickname;
            $posts[$i]->location = $posts[$i]->place->name;
            $posts[$i]->nLikes = $posts[$i]->likes()->count();
        }

        return $posts;
    }

    public function getUser($id)
    {
        $user = User::find($id);
        if(!$user){
            return null;
        }
        $user->posts = $user->posts()->count();
        $user->password = null;
        $user->lastfm_session_key = null;
        return $user;
    }

    public function getUserPosts($id)
    {
        $user = User::find($id);
        
        if(!$user){
            return null;
        }

        $posts = $user->posts;

        for($i = 0; $i < $posts->count(); $i+=1){
            $posts[$i]->userImg = $user->profile_pic;
            $posts[$i]->userName = $user->nickname;
            $posts[$i]->location = Place::find($posts[$i]->place_id)->name;
            $posts[$i]->nLikes = $posts[$i]->likes()->count();
        }
        return $posts;
    }

    public function getLikedPosts($id)
    {
        $user = User::find($id);

        $posts = $user->likes;

        for($i = 0; $i < $posts->count(); $i+=1){
            $targetUser = User::find($posts[$i]->user_id);

            $posts[$i]->usrImg = $targetUser->profile_pic;
            $posts[$i]->usrName = $targetUser->nickname;
            $posts[$i]->location = Place::find($posts[$i]->place_id)->name;
            $posts[$i]->nLikes = $posts[$i]->likes()->count();
        }
        return $posts;
    }

    public function getUsers(){
        $users = User::all();
        for($i = 0; $i<$users->count(); $i+=1){
            $users[$i]->nPosts = $users[$i]->posts()->count();
            $users[$i]->nVisits = $users[$i]->visits()->count();
        }
        return $users;
    }

    public function getVisited($usrID){
        $locations = User::find($usrID)->visits;

        if(!$locations){
            return null;
        }

        foreach($locations as $location){
            $location->posts = $location->posts()->count();
            $location->visits = $location->visits()->count();
        }

        return $locations;
    }

}