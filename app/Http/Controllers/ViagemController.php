<?php

namespace App\Http\Controllers;

use App\Rota;
use App\Viagem;
use App\Viatura;
use Illuminate\Http\Request;

class ViagemController extends Controller
{
    public function index()
    {
        $viagens = Viagem::all();
        return view('viagens.index', compact('viagens'));
    }

    public function create()
    {
        // Carregar dados necessários para preencher dropdowns, como Rotas e Viaturas
        $rotas = Rota::all();
        $viaturas = Viatura::all();
        return view('viagens.create', compact('rotas', 'viaturas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'data_viagem' => 'required|date',
            'rota_id' => 'required|exists:rotas,id',
            'viatura_id' => 'required|exists:viaturas,id',
        ]);

        Viagem::create($validatedData);

        return redirect()->route('viagens.index')->withStatus('Viagem adicionada com sucesso.');
    }

    public function show(Viagem $viagem)
    {
        return view('viagens.show', compact('viagem'));
    }

    public function edit(Viagem $viagem)
    {
        $rotas = Rota::all();
        $viaturas = Viatura::all();
        return view('viagens.edit', compact('viagem', 'rotas', 'viaturas'));
    }

    public function update(Request $request, Viagem $viagem)
    {
        $validatedData = $request->validate([
            'data_viagem' => 'required|date',
            'rota_id' => 'required|exists:rotas,id',
            'viatura_id' => 'required|exists:viaturas,id',
        ]);

        $viagem->update($validatedData);

        return redirect()->route('viagens.index')->withStatus('Viagem atualizada com sucesso.');
    }

    public function destroy(Viagem $viagem)
    {
        $viagem->delete();

        return redirect()->route('viagens.index')->withStatus('Viagem deletada com sucesso.');
    }
}
