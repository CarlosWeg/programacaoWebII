<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imc extends Model
{
    public static function calculate($weight, $height)
    {
        // Converte altura de cm para metros (se necessário)
        $heightInMeters = $height < 3 ? $height : $height / 100; // Detecta automaticamente a unidade
        
        $imc = $weight / ($heightInMeters ** 2);
        
        $category = match(true) {
            $imc < 18.5 => 'Abaixo do peso',
            $imc < 25   => 'Peso normal',
            $imc < 30   => 'Sobrepeso',
            $imc < 35   => 'Obesidade Grau I',
            $imc < 40   => 'Obesidade Grau II',
            default     => 'Obesidade Grau III'
        };
    
        return [
            'imc' => number_format($imc, 2),
            'category' => $category
        ];
    }
}