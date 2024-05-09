<?php

namespace App\Models;

class Service
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string, bool>
     */
    protected $fillable = [
        'service_name',
        'service_type',
        'description',
        'price',
        'availability',
        'business_id'
    ];
}