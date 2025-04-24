<?php

namespace App\Http\Controllers;

use App\Models\TipoContato;
use Illuminate\Http\Request;

class TipoContatoController extends Controller
{
    public function index()
    {
        $tiposContato = TipoContato::all();
        return view('tipo_contato.index', compact('tiposContato'));
    }

    public function create()
    {
        return view('tipo_contato.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        TipoContato::create($request->all());

        return redirect()->route('tipo-contato.index')
            ->with('success', 'Tipo de contato criado com sucesso.');
    }

    public function show(TipoContato $tipoContato)
    {
        return view('tipo_contato.show', compact('tipoContato'));
    }

    public function edit(TipoContato $tipoContato)
    {
        return view('tipo_contato.edit', compact('tipoContato'));
    }

    public function update(Request $request, TipoContato $tipoContato)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $tipoContato->update($request->all());

        return redirect()->route('tipo-contato.index')
            ->with('success', 'Tipo de contato atualizado com sucesso');
    }

    public function destroy(TipoContato $tipoContato)
    {
        $tipoContato->delete();

        return redirect()->route('tipo-contato.index')
            ->with('success', 'Tipo de contato excluído com sucesso');
    }
}