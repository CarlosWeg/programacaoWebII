<?php

namespace App\Http\Controllers;

use App\Models\Imc;
use Illuminate\Http\Request;

class ImcController extends Controller
{
    public function show()
    {
        return view('imc');
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'weight' => 'required|numeric|min:1|max:300',
            'height' => 'required|numeric|min:30|max:250'
        ]);

        $result = Imc::calculate($validated['weight'], $validated['height']);
        
        return view('imc', compact('result'));
    }
}