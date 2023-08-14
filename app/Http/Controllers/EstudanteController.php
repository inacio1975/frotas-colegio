<?php

namespace App\Http\Controllers;

use App\Estudante;
use App\Http\Requests\ClientRequest;
use App\Rota;
use Illuminate\Http\Request;

class EstudanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudantes = Estudante::all();

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
            'numero' => 'required|string|max:255',
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
        $estudante = Estudante::create($validatedData);

        return redirect()->route('estudantes.index')->withStatus('Estudante Registrado com sucesso.');
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
        $faturasEmAtraso = $estudante->faturas()->where('status_pagamento', 'pendente')->where('data_vencimento', '<', now())->get();
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
        return view('estudantes.edit', compact('estudante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request\ClientRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Estudante $client)
    {
        $client->update($request->all());

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
}
