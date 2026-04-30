@extends('layouts.default')
@section('content')
    
<div class="content-grid" id="lista">
    @foreach($movies as $movie)
        <a href="" class="movie-card">
            <div class="movie-frame">
                <img src="https://image.tmdb.org/t/p/w780{{ $movie->backdrop_path ?? $movie->poster_path }}" 
                     alt="{{ $movie->title }}" 
                     loading="lazy">
            </div>

            <div class="movie-info">
                <div class="movie-meta">
                      

                    <span>RELEASE: {{ \Carbon\Carbon::parse($movie->release_date)->format('Y') }}</span>
                </div>
                
                <div class="d-flex justify-content-between align-items-end border-bottom border-secondary pb-2 mb-3">
    <div class="flex-grow-1">
        <h3 class="movie-title m-0 text-uppercase fw-black tracking-tighter">
            {{ $movie->title }}
        </h3>
    </div>

    <div class="text-end">
        @if($movie->review)
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted small font-monospace uppercase">Rating</span>
                <h4 class="m-0 fw-bold" style="color: {{ $movie->review->rating >= 8 ? 'var(--accent-color)' : '#8f7777' }};">
                    {{ number_format($movie->review->rating, 1) }}<span class="small opacity-50">/10</span>
                </h4>
            </div>
        @else
            <span class="text-muted small font-monospace uppercase opacity-50">No Review</span>
        @endif
    </div>
</div>

                
                <p class="small  m-0" style="font-size: 0.75rem; line-height: 1.4;">
                    {{ Str::limit($movie->overview, 100) }}
                </p>

                        @if($movie->review)

    <div class="mt-3 pt-2 border-top border-dark opacity-75">
        <span class="font-monospace d-block mb-1" style="font-size: 0.6rem; letter-spacing: 2px; text-transform: uppercase;">
Critica sobre o Filme
        </span>
        
        <p class="small m-0  italic" style=" line-height: 1.5; font-style: italic;">
            "{{ ($movie->review->body) }}"
        </p>
    </div>
@endif
                    
                    

                </p>
            </div>
        </a>
    @endforeach

@endsection
