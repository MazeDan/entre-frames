<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    protected $casts = [
    'watched' => 'boolean',
    'added_at' => 'datetime',
    'watched_at' => 'datetime',
   
];

protected $fillable = [
        'movie_id',
        'watched',
        'priority',
        'added_at',
        'watched_at',
    ];

public function movie()
{
    return $this->belongsTo(Movie::class);
}
}
