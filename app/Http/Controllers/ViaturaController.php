<?php

namespace App\Http\Controllers;

use App\Viagem;
use App\Viatura;
use Illuminate\Http\Request;

class ViaturaController extends Controller
{
    public function index(Request $request)
    {
        $mesSelecionado = $request->input('mes');

        $viaturas = Viatura::with('viagens')
        ->when($mesSelecionado, function ($query) use ($mesSelecionado) {
            $query->whereHas('viagens', function ($q) use ($mesSelecionado) {
                $q->whereMonth('data_viagem', $mesSelecionado);
            });
        })
        ->get();

        foreach ($viaturas as $viatura) {
            $quantidadeViagensMes = $viatura->viagens->filter(function ($viagem) use ($mesSelecionado) {
                return $viagem->data_viagem->format('m') == $mesSelecionado;
            })->count();

            $valorAPagar = $viatura->valor_pagar_mes - ($viatura->penalizacao_dia * (22 - $quantidadeViagensMes));
            $viatura->valor_a_pagar = max(0, $valorAPagar);
            $viatura->quantidade_viagens_mes = $quantidadeViagensMes;
        }


        return view('viaturas.index', compact('viaturas', 'mesSelecionado'));
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
