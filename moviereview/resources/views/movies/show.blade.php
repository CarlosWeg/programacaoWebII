@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            @if($movie->poster_url)
                <img src="{{ $movie->poster_url }}" class="img-fluid rounded" alt="{{ $movie->title }}">
            @else
                <div class="bg-secondary rounded p-5 text-center">
                    <i class="fas fa-film fa-5x text-muted"></i>
                </div>
            @endif
        </div>
        
        <div class="col-md-8">
            <h1>{{ $movie->title }}</h1>
            <div class="mb-3">
                <span class="badge bg-secondary me-2">{{ $movie->genre }}</span>
                <span class="text-muted">{{ $movie->year }} • {{ $movie->duration }} min</span>
            </div>
            
            <div class="mb-3">
                <h5>Diretor:</h5>
                <p>{{ $movie->director }}</p>
            </div>
            
            <div class="mb-3">
                <div class="d-flex align-items-center">
                    <div class="rating-stars me-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($movie->averageRating()))
                                <i class="fas fa-star fa-lg"></i>
                            @elseif($i - 0.5 <= $movie->averageRating())
                                <i class="fas fa-star-half-alt fa-lg"></i>
                            @else
                                <i class="far fa-star fa-lg"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="h5 mb-0">{{ number_format($movie->averageRating(), 1) }}/5</span>
                    <span class="text-muted ms-2">({{ $movie->totalReviews() }} avaliações)</span>
                </div>
            </div>
            
            <div class="mb-4">
                <h5>Sinopse:</h5>
                <p>{{ $movie->synopsis }}</p>
            </div>
            
            @auth
                <div class="mb-4">
                    @if(auth()->user()->can('update', $movie))
                        <a href="{{ route('movies.edit', $movie) }}" class="btn btn-outline-warning me-2">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    @endif
                    @if(auth()->user()->can('delete', $movie))
                        <form method="POST" action="{{ route('movies.destroy', $movie) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" 
                                    onclick="return confirm('Tem certeza que deseja excluir este filme?')">
                                <i class="fas fa-trash"></i> Excluir
                            </button>
                        </form>
                    @endif
                </div>
            @endauth
        </div>
    </div>
    
    <hr class="my-5">
    
    <!-- Seção de Reviews -->
    <div class="row">
        <div class="col-md-12">
            <h3>Avaliações</h3>
            
            @auth
                <!-- Formulário para nova review -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>{{ $userReview ? 'Editar sua avaliação' : 'Adicionar avaliação' }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('reviews.store') }}">
                            @csrf
                            <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                            
                            <div class="mb-3">
                                <label class="form-label">Nota (0.5 a 5.0)</label>
                                <select name="rating" class="form-select" required>
                                    <option value="">Selecione uma nota</option>
                                    @for($i = 0.5; $i <= 5; $i += 0.5)
                                        <option value="{{ $i }}" {{ $userReview && $userReview->rating == $i ? 'selected' : '' }}>
                                            {{ $i }} estrelas
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Comentário (opcional)</label>
                                <textarea name="comment" class="form-control" rows="4" 
                                          placeholder="Compartilhe sua opinião sobre o filme...">{{ $userReview ? $userReview->comment : '' }}</textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Data que assistiu (opcional)</label>
                                <input type="date" name="watched_date" class="form-control" 
                                       value="{{ $userReview ? $userReview->watched_date?->format('Y-m-d') : '' }}">
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                {{ $userReview ? 'Atualizar' : 'Publicar' }} Avaliação
                            </button>
                            
                            @if($userReview)
                                <form method="POST" action="{{ route('reviews.destroy', $userReview) }}" class="d-inline ms-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" 
                                            onclick="return confirm('Deseja excluir sua avaliação?')">
                                        Excluir Avaliação
                                    </button>
                                </form>
                            @endif
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    <a href="{{ route('login') }}">Faça login</a> para avaliar este filme.
                </div>
            @endauth
            
            <!-- Lista de Reviews -->
            @forelse($movie->reviews as $review)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="card-title mb-1">{{ $review->user->name }}</h6>
                                <div class="rating-stars">
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
                            </div>
                            <small class="text-muted">
                                {{ $review->created_at->diffForHumans() }}
                                @if($review->watched_date)
                                    <br>Assistiu em: {{ $review->watched_date->format('d/m/Y') }}
                                @endif
                            </small>
                        </div>
                        
                        @if($review->comment)
                            <p class="card-text">{{ $review->comment }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-4">
                    <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                    <h5>Nenhuma avaliação ainda</h5>
                    <p class="text-muted">Seja o primeiro a avaliar este filme!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection