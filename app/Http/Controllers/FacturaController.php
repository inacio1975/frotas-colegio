<?php

namespace App\Http\Controllers;

use App\Estudante;
use App\Factura;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mesSelecionado = $request->input('mes');
        $query = Factura::whereYear('data_emissao', Carbon::now()->year);

        if ($mesSelecionado) {
            $query->whereMonth('data_emissao', $mesSelecionado);
        }

        $facturas = $query->get();

        return view('estudantes.facturas.index', compact('mesSelecionado', 'facturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $mesSelecionado = $request->input('mes');
        return view('estudantes.facturas.create', compact('mesSelecionado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mesSelecionado = $request->input('mes');

        // Obtém os estudantes que ainda não têm fatura para o mês selecionado
        $estudantes = Estudante::whereDoesntHave('facturas', function ($query) use ($mesSelecionado) {
            $query->whereYear('data_emissao', Carbon::now()->year)
                ->whereMonth('data_emissao', $mesSelecionado);
        })->get();

        foreach ($estudantes as $estudante) {
            // Crie uma nova fatura para o estudante
            $fatura = new Factura();
            $fatura->valor = $estudante->rota->valor_a_pagar;
            $fatura->data_emissao = Carbon::now()->setMonth($mesSelecionado);
            $fatura->data_vencimento = Carbon::now()->setMonth($mesSelecionado)->addDays(10);
            $fatura->estudante_id = $estudante->id;
            $fatura->save();
        }

        return view('estudantes.facturas.index', compact('mesSelecionado'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
