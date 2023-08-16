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
                    <h6 class="heading-small text-muted mb-4">Informação do Estudante</h6>
                    <div class="row">
                        <div class="col-md-6 border">
                            <p class="heading-small"><b>Número:</b> {{ $estudante->numero }}</p>
                            <p class="heading-small"><b>Idade:</b> {{ $estudante->idade }}</p>
                            <p class="heading-small"><b>Sexo:</b> {{ $estudante->sexo }}</p>
                            <p class="heading-small"><b>Classe / Turno:</b> {{ $estudante->classe }} / {{ $estudante->turno }}</p>
                            <p class="heading-small"><b>Morada:</b> {{ $estudante->morada }}</p>
                            <p class="heading-small"><b>Encarregado:</b> {{ $estudante->nome_encarregado }}</p>
                            <p class="heading-small"><b>Telefone:</b> <a href="tel:{{ $estudante->telefone }}">{{ $estudante->telefone }}</a></p>
                            <p class="heading-small"><b>Rota:</b> {{ $estudante->rota->nome }}</p>
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
                                            <td>
                                                @if ($factura->status_pagamento === 'Pendente')
                                                    @if ($factura->data_vencimento->isPast())
                                                        <span class="badge badge-danger">Atrasado</span>
                                                    @else
                                                        <span class="badge badge-warning">Pendente</span>
                                                    @endif
                                                @else
                                                    <span class="badge badge-success">Pago</span>
                                                @endif
                                            </td>

                                            <td>@if ($factura->status_pagamento === 'Pendente')
                                                <a href="{{ route('estudantes.transactions.add', ['estudante' => $estudante->id, 'factura' => $factura->id]) }}" class="btn btn-sm btn-primary">Pagamento</a>
                                            @endif
                                        </td>
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
                                    <td>{{ format_money($transaction->amount) }}</td>
                                    <td>{{ $transaction->method->name }}</td>
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
