<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function show()
    {
        return view('travel');
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'distance' => 'required|numeric|min:1',
            'fuel_efficiency' => 'required|numeric|min:1',
            'fuel_price' => 'required|numeric|min:0.1'
        ]);

        $cost = Travel::calculateCost(
            $validated['distance'],
            $validated['fuel_efficiency'],
            $validated['fuel_price']
        );

        return view('travel', compact('cost'));
    }
}