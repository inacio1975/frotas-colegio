<?php

namespace App\Http\Controllers;

use App\Rota;
use Illuminate\Http\Request;

class RotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rotas = Rota::all();
        return view('rotas.index', compact('rotas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rotas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'ponto_partida' => 'required|string|max:255',
            'ponto_chegada' => 'required|string|max:255',
            'horario_partida' => 'required|date_format:H:i',
        ]);

        // Criação da rota
        $rota = Rota::create($validatedData);

        // Redirecionamento para a página da rota ou para onde você desejar
        return redirect()->route('rotas.index')
            ->withStatus('Rota criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rota = Rota::findOrFail($id);
        return view('rotas.show', compact('rota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rota = Rota::findOrFail($id);
        return view('rotas.edit', compact('rota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rota $rota)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'ponto_partida' => 'required|string|max:255',
            'ponto_chegada' => 'required|string|max:255',
            'horario_partida' => 'required|date_format:H:i',
        ]);

        // Atualização da rota
        $rota->update($validatedData);

        // Redirecionamento para a página da rota ou para onde você desejar
        return redirect()->route('rotas.index')
            ->withStatus('Rota atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rota $rota)
    {
        // Exclusão da rota
        $rota->delete();

        // Redirecionamento para a página da lista de rotas ou para onde você desejar
        return redirect()->route('rotas.index')
            ->withStatus('Rota excluída com sucesso.');
    }
}
