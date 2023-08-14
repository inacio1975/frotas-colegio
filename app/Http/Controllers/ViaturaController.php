<?php

namespace App\Http\Controllers;

use App\Viagem;
use App\Viatura;
use Illuminate\Http\Request;

class ViaturaController extends Controller
{
    public function index()
    {
        $viaturas = Viatura::all();
        return view('viaturas.index', compact('viaturas'));
    }

    public function create()
    {
        return view('viaturas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'modelo' => 'required',
            'matricula' => 'required|unique:viaturas',
            'capacidade' => 'required|numeric',
        ]);

        Viatura::create($request->all());

        return redirect()->route('viaturas.index')->withStatus('Viatura adicionada com sucesso!');
    }

    public function show(Viatura $viatura)
    {
        $month = request('month') ?? now()->format('Y-m');
        $viagens = Viagem::where('viatura_id', $viatura->id)
            ->whereYear('data_viagem', '=', substr($month, 0, 4))
            ->whereMonth('data_viagem', '=', substr($month, 5, 2))
            ->get();

        return view('viaturas.show', compact('viatura', 'viagens'));
    }

    public function edit(Viatura $viatura)
    {
        return view('viaturas.edit', compact('viatura'));
    }

    public function update(Request $request, Viatura $viatura)
    {
        $request->validate([
            'modelo' => 'required',
            'matricula' => 'required|unique:viaturas,matricula,' . $viatura->id,
            'capacidade' => 'required|numeric',
        ]);

        $viatura->update($request->all());

        return redirect()->route('viaturas.index')->withStatus('Viatura atualizada com sucesso!');
    }

    public function destroy(Viatura $viatura)
    {
        $viatura->delete();

        return redirect()->route('viaturas.index')->withStatus('Viatura excluída com sucesso!');
    }
}
