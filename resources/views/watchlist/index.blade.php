@extends('layouts.default')
@section('content')

<div class="content-grid" id="lista">
    @foreach($watchlists as $item)
        @php $movie = $item->movie; @endphp
        
        <a href="#" class="movie-card">
            <div class="movie-frame">
                <img src="https://image.tmdb.org/t/p/w780{{ $movie->backdrop_path ?? $movie->poster_path }}" 
                     alt="{{ $movie->title }}" 
                     style="filter: grayscale(100%) contrast(1.2);"
                     loading="lazy">
                
                <div class="position-absolute top-0 start-0 p-3">
                    <span class="badge rounded-0 bg-black border border-secondary text-white font-monospace" style="font-size: 0.6rem;">
                        PRIORITY_P{{ $item->priority }}
                    </span>
                </div>
            </div>

            <div class="movie-info">
                <div class="movie-meta">
                    <span>ADDED: {{ $item->added_at?->format('d.m.Y') ?? 'N/A' }}</span>
                    <span>RELEASE: {{ \Carbon\Carbon::parse($movie->release_date)->format('Y') }}</span>
                </div>
                
                <div class="d-flex justify-content-between align-items-end border-bottom border-secondary pb-2 mb-3">
                    <div class="flex-grow-1">
                        <h3 class="movie-title m-0 text-uppercase fw-black tracking-tighter">
                            {{ $movie->title }}
                        </h3>
                    </div>

                    <div class="text-end">
                        <span class="text-muted small font-monospace uppercase opacity-50">Pending_Action</span>
                    </div>
                </div>

                <p class="small m-0" style="font-size: 0.75rem; line-height: 1.4; color: #888;">
                    {{ Str::limit($movie->overview, 140) }}
                </p>

                <div class="mt-3 pt-2 border-top border-dark opacity-75 d-flex justify-content-between align-items-center">
                    <span class="font-monospace text-muted" style="font-size: 0.6rem; letter-spacing: 1px; text-transform: uppercase;">
                        Status: In_Queue
                    </span>
                    <span class="font-monospace" style="font-size: 0.6rem; color: var(--accent-color);">
                        [WAITING_FOR_CAPTURE]
                    </span>
                </div>
            </div>
        </a>
    @endforeach
</div>

@endsection