@extends('layouts.app', ['page' => 'Detalhes do Estudante', 'pageSlug' => 'estudantes-show', 'section' => 'estudantes'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">{{ $estudante->nome }}</h4>
                        <a href="{{ route('estudantes.edit', $estudante) }}" class="btn btn-sm btn-info">Editar</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 border">
                            <h5>Informações do Estudante</h5>
                            <p><strong>Número:</strong> {{ $estudante->numero }}</p>
                            <p><strong>Idade:</strong> {{ $estudante->idade }}</p>
                            <p><strong>Sexo:</strong> {{ $estudante->sexo }}</p>
                            <p><strong>Classe / Turno:</strong> {{ $estudante->classe }} / {{ $estudante->turno }}</p>
                            <p><strong>Morada:</strong> {{ $estudante->morada }}</p>
                            <p><strong>Encarregado:</strong> {{ $estudante->nome_encarregado }}</p>
                            <p><strong>Telefone:</strong> <a href="tel:{{ $estudante->telefone }}">{{ $estudante->telefone }}</a></p>
                            <p><strong>Rota:</strong> {{ $estudante->rota->nome }}</p>
                        </div>
                        <div class="col-md-6 border border-black">
                            <h5>Facturas Recentes</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Data Emissão</th>
                                        <th>Valor</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estudante->facturas->take(5) as $factura)
                                        <tr>
                                            <td>{{ $factura->data_emissao }}</td>
                                            <td>{{ format_money($factura->valor) }}</td>
                                            <td>{{ $factura->status_pagamento }}</td>
                                            <td><a href="{{ route('estudantes.transactions.add', ['estudante' => $estudante->id, 'factura' => $factura->id]) }}" class="btn btn-sm btn-primary">Pagamento</a></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="#" class="btn btn-sm btn-link">Ver Todos</a>
                        </div>
                    </div>
                    <hr>
                    <h5>Transações Recentes</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Referência</th>
                                <th>Valor</th>
                                <th>Método de Pagamento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estudante->transactions->take(5) as $transaction)
                                <tr>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>{{ $transaction->reference }}</td>
                                    <td>{{ $transaction->amount }}</td>
                                    <td>{{ $transaction->paymentMethod->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-sm btn-link">Ver Todas</a>
                </div>
            </div>
        </div>
    </div>
@endsection
