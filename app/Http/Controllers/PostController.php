<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Place;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function post(Request $request){

        if(trim($request->content) == ''){
            return ["success" => false, "message" => "Devi scrivere qualcosa"];
        }else if($request->userID == ''){
            return ["success" => false, "message" => "Devi essere loggato"];
        }else if($request->placeID == ''){
            return ["success" => false, "message" => "Non è un luogo"];
        }

        $post = new Post;
        $post->place_id = $request->placeID;
        $post->user_id = $request->userID;
        $post->content = $request->content;

        $post->save();

        return ["success" => true, "message" => "Tutto apposto"];
    }

    public function likePost($cardID){

        $post = Post::find($cardID);

        if(!$post){
            return null;
        }

        if(!session('user_id', false)){
            return $post->likes()->count();
        }

        $check = Like::where('user_id', session('user_id'))->where('post_id', $cardID)->delete();

        if($check > 0){
        }else{
            $like = new Like;

            $like->user_id = session('user_id');
            $like->post_id = $cardID;

            $like->save();
        }

        return $post->likes()->count();
    }

    public function removePost($cardID){
        if(!session('user_id', false)){
            return null;
        }

        $post = Post::find($cardID);

        if(!$post){
            return null;
        }

        if(session('user_id') != $post->user_id){
            if(!User::find(session('user_id'))->moderator){
                return null;
            }
        }

        $post->delete();

        return true;
    }

}