@extends('layout')

@section('content')
    <h1>Calculadora de IMC</h1>
    <form method="POST" action="{{ route('imc.calculate') }}">
        @csrf
        <div>
            <label>Peso (kg):</label>
            <input type="number" step="0.1" name="weight" required>
        </div>
        <div>
            <label>Altura (cm):</label> <!-- Alterado para cm -->
            <input type="number" name="height" step="0.01" required>
        </div>
        <button type="submit">Calcular</button>
    </form>

    @isset($result)
        <div class="result">
            <h3>Resultado:</h3>
            <p>IMC: {{ $result['imc'] }}</p>
            <p>Classificação: {{ $result['category'] }}</p>
        </div>
    @endisset
@endsection