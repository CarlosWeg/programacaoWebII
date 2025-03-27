<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    public static function calculateCost($distance, $efficiency, $price)
    {
        $liters = $distance / $efficiency;
        return [
            'liters' => number_format($liters, 2),
            'cost' => number_format($liters * $price, 2)
        ];
    }
}