<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entre Frames | Studio</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --border-color: #333; /* Cor das linhas da grade */
            --bg-color: #000;
            --accent-color: #e50914;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: #ffffff;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            
        }

        /* Container da Grade Principal */
        .grid-header {
            display: flex;
            flex-wrap: wrap;
            border-bottom: 2px solid var(--border-color);
        }

        /* Blocos da Grade */
        .grid-item {
            border-right: 2px solid var(--border-color);
            border-bottom: 2px solid var(--border-color);
            padding: 1.5rem;
            transition: all 0.2s ease;
            text-decoration: none;
            color: white;
        }

        .grid-item:last-child { border-right: none; }

        /* Estilo para a marca/nome grande */
        .brand-block {
            font-weight: 900;
            font-size: clamp(2rem, 8vw, 5rem);
            line-height: 0.9;
            text-transform: uppercase;
            letter-spacing: -3px;
        }

        /* Blocos de navegação e info */
        .nav-block {
            flex: 1 1 25%;
            font-size: 0.9rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .nav-block h2 {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #666;
            margin-bottom: 1rem;
        }

        /* Efeito de hover similar ao estilo solicitado */
        a.grid-item:hover {
            background-color: #fff;
            color: #000;
        }
        
        a.grid-item:hover h2 { color: #888; }

        .social-icons {
            display: flex;
            gap: 15px;
            font-size: 1.3rem;
        }

        /* Área de Conteúdo (Simulando os cards de imagem do Eric Hu) */
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }

        .content-item {
            aspect-ratio: 16/9;
            border-right: 2px solid var(--border-color);
            border-bottom: 2px solid var(--border-color);
            background: #111;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .content-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    border-top: none;
}

.movie-card {
    display: flex;
    flex-direction: column;
    border-right: 2px solid var(--border-color);
    border-bottom: 2px solid var(--border-color);
    text-decoration: none;
    color: white;
    transition: all 0.3s ease;
    background: #000;
}

/* Imagem do Filme (Aspecto de Frame) */
.movie-frame {
    width: 100%;
    aspect-ratio: 16 / 9;
    overflow: hidden;
    position: relative;
    border-bottom: 2px solid var(--border-color);
}

.movie-frame img {
    width: 100%;
    h-8: 100%;
    object-fit: cover;
    filter: grayscale(100%); /* Começa P&B para o estilo brutalista */
    transition: all 0.5s ease;
}

/* Informações do Filme */
.movie-info {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.movie-meta {
    font-size: 0.65rem;
    font-family: 'Monaco', 'Consolas', monospace;
    text-transform: uppercase;
    color: #666;
    display: flex;
    justify-content: space-between;
}

.movie-title {
    font-weight: 900;
    font-size: 1.5rem;
    text-transform: uppercase;
    line-height: 1;
    margin: 0;
}

/* Efeito Hover Estilo Eric Hu */
.movie-card:hover {
    background-color: #fff;
    color: #000;
}

.movie-card:hover .movie-frame img {
    filter: grayscale(0%);
    transform: scale(1.05);
}

.movie-card:hover .movie-meta {
    color: #888;
}

        @media (max-width: 768px) {
            .nav-objective { flex: 1 1 100%; border-right: none; }
        }
    </style>
</head>
<body>

    <div class="grid-header">
        
        <div class="grid-item brand-block">
            ENTRE<br><span style="color: var(--accent-color)">FRAMES</span>
        </div>



        <a href="/portfolio" class="grid-item nav-block">
            <h2>Navegação</h2>
            <div>
                <strong>VOLTAR AO PORTFÓLIO</strong>
                <p class="m-0 text-muted small">Retornar à página principal</p>
            </div>
        </a>

        <a href="#lista" class="grid-item nav-block">
            <h2>Curadoria</h2>
            <div>
                <strong>MINHA LISTA</strong>
                <p class="m-0 text-muted small">Seleção de frames favoritos</p>
            </div>
        </a>

           <div class="grid-item nav-block nav-objective">
            <h2>Objetivo do Projeto</h2>
            <p>Uma exploração visual sobre a técnica cinematográfica, decompondo filmes em seus elementos fundamentais para entender a narrativa através da luz e composição.</p>
            </div>
    

    </div>


    
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
        <span class="font-monospace text-muted d-block mb-1" style="font-size: 0.6rem; letter-spacing: 2px; text-transform: uppercase;">
Critica sobre o Filme
        </span>
        
        <p class="small m-0 text-secondary italic" style="font-size: 0.75rem; line-height: 1.5; font-style: italic;">
            "{{ Str::limit($movie->review->body, 120) }}"
        </p>
    </div>
@endif
                    
                    

                </p>
            </div>
        </a>
    @endforeach
</div>
</body>
</html>