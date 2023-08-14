@extends('layouts.app', ['page' => 'Detalhes da Rota', 'pageSlug' => 'rotas', 'section' => 'rotas'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $rota->nome }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Ponto de Partida:</strong> {{ $rota->ponto_partida }}</p>
                            <p><strong>Ponto de Chegada:</strong> {{ $rota->ponto_chegada }}</p>
                            <p><strong>Horário de Partida:</strong> {{ $rota->horario_partida }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('rotas.edit', $rota) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ route('rotas.index') }}" class="btn btn-secondary">Voltar à Lista</a>
                </div>
            </div>
        </div>
    </div>
@endsection
