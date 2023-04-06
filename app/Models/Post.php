<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo('App\Models\User');   // user_id
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');  // category_id
    }

    public function tags(){
        return $this->hasMany('App\Models\Tag', 'postID', 'id');
    }

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }
}
