<?php

namespace App\Http\Controllers;

use App\Models\Sleep;
use Illuminate\Http\Request;

class SleepController extends Controller
{
    public function show()
    {
        return view('sleep');
    }

    public function evaluate(Request $request)
    {
        $validated = $request->validate([
            'hours' => 'required|numeric|between:0,24',
            'age' => 'required|integer|min:1'
        ]);

        $recommendation = Sleep::evaluate($validated['hours'], $validated['age']);
        
        return view('sleep', compact('recommendation'));
    }
}