@extends('layout')

@section('content')
    <h1>Cálculo de Custo de Viagem</h1>
    <form method="POST" action="{{ route('travel.calculate') }}">
        @csrf
        <div>
            <label>Distância (km):</label>
            <input type="number" step="1" name="distance" required>
        </div>
        <div>
            <label>Consumo (km/l):</label>
            <input type="number" step="0.1" name="fuel_efficiency" required>
        </div>
        <div>
            <label>Preço do combustível (por litro):</label>
            <input type="number" step="0.01" name="fuel_price" required>
        </div>
        <button type="submit">Calcular</button>
    </form>

    @isset($cost)
        <div class="result">
            <h3>Resultado:</h3>
            <p>Litros necessários: {{ $cost['liters'] }}</p>
            <p>Custo total: R$ {{ $cost['cost'] }}</p>
        </div>
    @endisset
@endsection