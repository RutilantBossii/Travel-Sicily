<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function place(){
        return $this->belongsTo(Place::class);
    }

    public function likes(){
        return $this->belongsToMany(User::class);
    }
}