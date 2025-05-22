@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">
        <i class="fas fa-comments me-2"></i>Últimas Reviews
    </h1>
    
    @forelse($reviews as $review)
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        @if($review->movie->poster_url)
                            <img src="{{ $review->movie->poster_url }}" class="img-fluid rounded" 
                                 alt="{{ $review->movie->title }}" style="max-height: 200px;">
                        @else
                            <div class="bg-secondary rounded p-3 text-center" style="height: 200px;">
                                <i class="fas fa-film fa-3x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h5>
                                    <a href="{{ route('movies.show', $review->movie) }}" class="text-decoration-none">
                                        {{ $review->movie->title }}
                                    </a>
                                </h5>
                                <p class="text-muted mb-1">{{ $review->movie->director }} • {{ $review->movie->year }}</p>
                            </div>
                            <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                        </div>
                        
                        <div class="mb-2">
                            <strong>{{ $review->user->name }}</strong>
                            <div class="rating-stars d-inline ms-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($review->rating))
                                        <i class="fas fa-star"></i>
                                    @elseif($i - 0.5 <= $review->rating)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                                <span class="ms-1">{{ $review->rating }}</span>
                            </div>
                            @if($review->watched_date)
                                <small class="text-muted ms-2">
                                    <i class="fas fa-calendar me-1"></i>Assistiu em {{ $review->watched_date->format('d/m/Y') }}
                                </small>
                            @endif
                        </div>
                        
                        @if($review->comment)
                            <p class="mb-0">{{ $review->comment }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-5">
            <i class="fas fa-comments fa-4x text-muted mb-3"></i>
            <h3>Nenhuma review encontrada</h3>
            <p class="text-muted">As avaliações dos usuários aparecerão aqui.</p>
        </div>
    @endforelse
    
    {{ $reviews->links() }}
</div>
@endsection