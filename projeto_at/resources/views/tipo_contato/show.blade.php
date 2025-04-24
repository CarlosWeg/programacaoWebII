@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Tipo de Contato</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $tipoContato->nome }}</h5>
            <p class="card-text">{{ $tipoContato->descricao }}</p>
            <p class="card-text"><small class="text-muted">Criado em: {{ $tipoContato->created_at->format('d/m/Y H:i') }}</small></p>
            <p class="card-text"><small class="text-muted">Atualizado em: {{ $tipoContato->updated_at->format('d/m/Y H:i') }}</small></p>
        </div>
    </div>
    
    <a href="{{ route('tipo-contato.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection