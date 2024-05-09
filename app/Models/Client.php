<?php

namespace App\Models;

class Client
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string, bool>
     */
    protected $fillable = [
        'name',
        'password',
        'email',
        'phone_number',
        'birthday',
        'sex',
        'address',
        'image'
    ];
}