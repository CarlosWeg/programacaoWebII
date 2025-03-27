@extends('layout')

@section('content')
    <h1>Bem-vindo ao Health Tools</h1>
    <p>Escolha uma ferramenta:</p>
    <ul>
        <li><a href="/imc">Calculadora de IMC</a></li>
        <li><a href="/sleep">Avaliação de Sono</a></li>
        <li><a href="/travel">Cálculo de Custo de Viagem</a></li>
    </ul>
@endsection