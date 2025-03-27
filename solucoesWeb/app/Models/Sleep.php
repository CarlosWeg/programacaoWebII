<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sleep extends Model
{
    public static function evaluate($hours, $age)
    {
        $recommended = match(true) {
            $age < 18 => 8.5,
            $age < 65 => 7.5,
            default => 7
        };

        $difference = $hours - $recommended;

        return [
            'hours' => $hours,
            'recommended' => $recommended,
            'status' => $difference >= 0 ? 'Suficiente' : 'Insuficiente',
            'message' => $difference >= 0 
                ? "Você está dormindo o suficiente!"
                : "Você precisa dormir mais " . abs($difference) . " horas"
        ];
    }
}