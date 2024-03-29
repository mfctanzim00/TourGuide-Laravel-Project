<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentNotification extends Model
{
    public function post() {
        return $this->belongsTo('App\Models\Post');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
