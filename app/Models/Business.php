<?php

namespace App\Models;

class Business
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'business_name',
        'business_type',
        'description',
        'image',
        'district_id'
    ];
}