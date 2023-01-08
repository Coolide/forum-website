<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    /**
     * Get all of the models that own comments.
     */
    public function votable()
    {
        return $this->morphTo();
    }

    protected $fillable = [
        'user_id',
        'post_id',
        'vote'
    ];
}
