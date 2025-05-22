@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="mb-4">
                <i class="fas fa-film me-2"></i>Catálogo de Filmes
            </h1>
            
            <!-- Filtros de Busca -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('movies.index') }}">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control search-bar" 
                                       placeholder="Buscar por título ou diretor..." 
                                       value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="genre" class="form-select search-bar">
                                    <option value="">Todos os gêneros</option>
                                    @foreach($genres as $genre)
                                        <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>
                                            {{ $genre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="year" class="form-select search-bar">
                                    <option value="">Todos os anos</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse($movies as $movie)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($movie->poster_url)
                        <img src="{{ $movie->poster_url }}" class="movie-poster" alt="{{ $movie->title }}">
                    @else
                        <div class="movie-poster bg-secondary d-flex align-items-center justify-content-center">
                            <i class="fas fa-film fa-3x text-muted"></i>
                        </div>
                    @endif
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $movie->title }}</h5>
                        <p class="text-muted mb-2">{{ $movie->director }} • {{ $movie->year }}</p>
                        <p class="text-warning mb-2">
                            <small>
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($movie->averageRating()))
                                        <i class="fas fa-star"></i>
                                    @elseif($i - 0.5 <= $movie->averageRating())
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                                <span class="ms-1">{{ number_format($movie->averageRating(), 1) }}</span>
                                <span class="text-muted">({{ $movie->reviews_count }} reviews)</span>
                            </small>
                        </p>
                        <p class="card-text flex-grow-1">{{ Str::limit($movie->synopsis, 100) }}</p>
                        <a href="{{ route('movies.show', $movie) }}" class="btn btn-primary">Ver Detalhes</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-film fa-4x text-muted mb-3"></i>
                    <h3>Nenhum filme encontrado</h3>
                    <p class="text-muted">Tente ajustar os filtros de busca.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{ $movies->links() }}
</div>
@endsection