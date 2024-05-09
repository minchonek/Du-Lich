<?php

namespace App\Models;

class Comment
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'post_id',
        'client_id'
    ];
}