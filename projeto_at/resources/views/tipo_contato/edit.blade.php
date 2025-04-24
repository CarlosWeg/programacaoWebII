@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Tipo de Contato</h1>
    
    <form action="{{ route('tipo-contato.update', $tipoContato->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $tipoContato->nome }}" required>
        </div>
        
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ $tipoContato->descricao }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('tipo-contato.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection