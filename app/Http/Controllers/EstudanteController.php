<?php

namespace App\Http\Controllers;

use App\Estudante;
use App\Factura;
use App\Http\Requests\ClientRequest;
use App\PaymentMethod;
use App\Rota;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EstudanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudantes = Estudante::with('rota', 'facturas')->get();
        foreach ($estudantes as $estudante) {
            $faturasAtraso = $estudante->facturas->where('status_pagamento', 'Pendente')->count();
            $estudante->faturasAtraso = $faturasAtraso;
        }


        return view('estudantes.index', compact('estudantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rotas = Rota::all(); // Recupere todas as rotas disponíveis
        return view('estudantes.create', compact('rotas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'numero' => 'required|integer|unique:estudantes',
            'nome' => 'required|string|max:255',
            'idade' => 'required|integer',
            'sexo' => 'required|string',
            'classe' => 'required|string',
            'turno' => 'required|string',
            'morada' => 'required|string',
            'nome_encarregado' => 'required|string',
            'telefone' => 'required|string',
            'rota_id' => 'required|exists:rotas,id',
        ]);

        // Criação do estudante
        Estudante::create($validatedData);

        // Redirecionamento para a página da lista de estudantes ou para onde você desejar
        return redirect()->route('estudantes.index')
            ->withStatus('Estudante criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estudante = Estudante::findOrFail($id);
        $faturasEmAtraso = $estudante->facturas()->where('status_pagamento', 'pendente')->where('data_vencimento', '<', now())->get();
        return view('estudantes.show', compact('estudante', 'faturasEmAtraso'));

        //return view('estudantes.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estudante = Estudante::findOrFail($id);
        $rotas = Rota::all(); // Recupere todas as rotas disponíveis
        return view('estudantes.edit', compact('estudante', 'rotas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request\ClientRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudante $estudante)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'numero' => 'required|integer|unique:estudantes,numero,' . $estudante->id,
            'idade' => 'required|integer',
            'sexo' => 'required|in:Masculino,Feminino',
            'classe' => 'required|string|max:255',
            'turno' => 'required|in:Manhã,Tarde',
            'morada' => 'required|string|max:255',
            'nome_encarregado' => 'required|string|max:255',
            'telefone' => 'required|string|max:255',
            'rota_id' => 'required|exists:rotas,id',
        ]);

        $estudante->update($validatedData);

        return redirect()
            ->route('estudantes.index')
            ->withStatus('Estudante modificado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudante $client)
    {
        $client->delete();

        return redirect()
            ->route('estudantes.index')
            ->withStatus('O Estudante foi eliminado.');
    }

    public function addtransaction(Estudante $estudante, Factura $factura)
    {
        $payment_methods = PaymentMethod::all();

        // Criar a referência única
        $nomeIniciais = Str::upper(Str::substr($estudante->nome, 0, 2)); // Pegar as duas primeiras letras em maiúsculas
        $dataReferencia = now()->format('Ymd'); // Formato YYYYMMDD
        $referencia = $factura->id . $nomeIniciais . $dataReferencia;

        return view('estudantes.transactions.add', compact('estudante', 'factura', 'payment_methods', 'referencia'));
    }
}
