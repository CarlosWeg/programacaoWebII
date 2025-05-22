@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Dashboard - {{ Auth::user()->name }}</h1>
        </div>
    </div>
    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-star fa-3x text-warning mb-3"></i>
                    <h3>{{ Auth::user()->totalReviews() }}</h3>
                    <p class="text-muted">Reviews Feitas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-chart-line fa-3x text-success mb-3"></i>
                    <h3>{{ number_format(Auth::user()->averageRating(), 1) }}</h3>
                    <p class="text-muted">Média das suas Notas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-film fa-3x text-info mb-3"></i>
                    <h3>{{ \App\Models\Movie::count() }}</h3>
                    <p class="text-muted">Total de Filmes</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h3>{{ \App\Models\User::count() }}</h3>
                    <p class="text-muted">Usuários Registrados</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Suas Últimas Reviews</h5>
                </div>
                <div class="card-body">
                    @php
                        $userReviews = Auth::user()->reviews()->with('movie')->latest()->take(5)->get();
                    @endphp
                    
                    @forelse($userReviews as $review)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <strong>{{ $review->movie->title }}</strong>
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                        </div>
                    @empty
                        <p class="text-muted">Você ainda não fez nenhuma review.</p>
                    @endforelse
                    
                    <a href="{{ route('reviews.index') }}" class="btn btn-outline-primary btn-sm">Ver Todas</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Filmes Mais Bem Avaliados</h5>
                </div>
                <div class="card-body">
                    @php
                        $topMovies = \App\Models\Movie::whereHas('reviews')
                            ->withCount('reviews')
                            ->get()
                            ->sortByDesc(function($movie) {
                                return $movie->averageRating();
                            })
                            ->take(5);
                    @endphp
                    
                    @forelse($topMovies as $movie)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <strong>{{ $movie->title }}</strong>
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($movie->averageRating()))
                                            <i class="fas fa-star text-warning"></i>
                                        @elseif($i - 0.5 <= $movie->averageRating())
                                            <i class="fas fa-star-half-alt text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                    <span class="ms-1">{{ number_format($movie->averageRating(), 1) }}</span>
                                </div>
                            </div>
                            <a href="{{ route('movies.show', $movie) }}" class="btn btn-outline-primary btn-sm">Ver</a>
                        </div>
                    @empty
                        <p class="text-muted">Nenhum filme avaliado ainda.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection