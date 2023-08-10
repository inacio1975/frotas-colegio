<?php

namespace App\Http\Controllers;

use App\Estudante;
use App\Http\Requests\ClientRequest;
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
        $estudantes = Estudante::paginate(25);

        return view('estudantes.index', compact('estudantes'));
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estudantes.create');
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        \Debugbar::info($request);
        Estudante::create($request->all());
        return redirect()->route('estudantes.index')->withStatus('Estudante Registrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Estudante $client)
    {
        return view('estudantes.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudante $client)
    {
        return view('estudantes.edit', compact('client'));
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
