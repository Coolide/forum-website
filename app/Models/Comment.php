<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function votes(){
        return $this->morphMany(Vote::class, 'votable');
    }

    protected $fillable = [
        'user_id',
        'post_id',
        'username',
        'description'
    ];
}
