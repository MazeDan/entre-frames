<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
    protected $fillable = [
        'title',
        'tmdb_id',
        'overview',
        'release_date',
        'poster_path',
        'backdrop_path'
    ];

    public function review()
{
    return $this->hasOne(Review::class);
}
}
