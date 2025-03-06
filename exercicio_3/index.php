<?php

require_once 'vendor/autoload.php';

use Faker\Factory;

$oFaker = Factory::create('pt_BR');

echo "Nome: " . $oFaker->name() . "<br>";
echo "Endereço: " . $oFaker->address() . "<br>";
echo "Email: " . $oFaker->email() . "<br>";
echo "Telefone: " . $oFaker->phoneNumber() . "<br>";
echo "Texto: " . $oFaker->text(200) . "<br>";
echo "CPF: " . $oFaker->cpf() . "<br>";
echo "CNPJ: " . $oFaker->cnpj() . "<br>";
echo "Data de Nascimento: " . $oFaker->date('d/m/Y') . "<br>";
echo "Cidade: " . $oFaker->city() . "<br>";
echo "Estado: " . $oFaker->state() . "<br>";