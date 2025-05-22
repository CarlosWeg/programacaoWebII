@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-edit me-2"></i>Editar Filme: {{ $movie->title }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('movies.update', $movie) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Título *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $movie->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="director" class="form-label">Diretor *</label>
                                    <input type="text" class="form-control @error('director') is-invalid @enderror" 
                                           id="director" name="director" value="{{ old('director', $movie->director) }}" required>
                                    @error('director')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="year" class="form-label">Ano *</label>
                                    <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                           id="year" name="year" value="{{ old('year', $movie->year) }}" min="1900" max="{{ date('Y') + 2 }}" required>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="duration" class="form-label">Duração (min) *</label>
                                    <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                                           id="duration" name="duration" value="{{ old('duration', $movie->duration) }}" min="1" required>
                                    @error('duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="genre" class="form-label">Gênero *</label>
                            <input type="text" class="form-control @error('genre') is-invalid @enderror" 
                                   id="genre" name="genre" value="{{ old('genre', $movie->genre) }}" required>
                            @error('genre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="poster_url" class="form-label">URL do Poster</label>
                            <input type="url" class="form-control @error('poster_url') is-invalid @enderror" 
                                   id="poster_url" name="poster_url" value="{{ old('poster_url', $movie->poster_url) }}">
                            @error('poster_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="synopsis" class="form-label">Sinopse *</label>
                            <textarea class="form-control @error('synopsis') is-invalid @enderror" 
                                      id="synopsis" name="synopsis" rows="5" required>{{ old('synopsis', $movie->synopsis) }}</textarea>
                            @error('synopsis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('movies.show', $movie) }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Atualizar Filme</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection