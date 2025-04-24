@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Novo Tipo de Contato</h1>
    
    <form action="{{ route('tipo-contato.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('tipo-contato.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection