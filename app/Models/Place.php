<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class Place extends Model
{
    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function visits(){
        return $this->belongsToMany(User::class);
    }
}