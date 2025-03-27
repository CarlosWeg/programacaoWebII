@extends('layout')

@section('content')
    <h1>Avaliação de Sono</h1>
    <form method="POST" action="{{ route('sleep.evaluate') }}">
        @csrf
        <div>
            <label>Idade:</label>
            <input type="number" name="age" required>
        </div>
        <div>
            <label>Horas dormidas:</label>
            <input type="number" step="0.5" name="hours" required>
        </div>
        <button type="submit">Avaliar</button>
    </form>

    @isset($recommendation)
        <div class="result">
            <h3>Resultado:</h3>
            <p>Recomendado: {{ $recommendation['recommended'] }} horas</p>
            <p>Seu sono: {{ $recommendation['status'] }}</p>
            <p>{{ $recommendation['message'] }}</p>
        </div>
    @endisset
@endsection