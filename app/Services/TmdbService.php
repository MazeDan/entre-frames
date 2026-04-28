<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TmdbService
{
    public function findMovie(string $title)
    {
        $baseUrl = config('services.tmdb.url');
        $token = config('services.tmdb.token');

        // Se a config vier vazia, o erro acontece. 
        // Vamos garantir que ela exista ou usar o fallback direto para teste:
        $url = $baseUrl ?: 'https://api.themoviedb.org/3';

        

        return Http::withToken($token)
            ->baseUrl($url) // Define a base separadamente
            ->get("/search/movie", [
                'query' => $title,
                'language' => 'pt-BR'
            ])->json('results');
    }
}