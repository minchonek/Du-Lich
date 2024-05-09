<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_name',
        'description',
        'image',
        'rating',
        'district_id',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
