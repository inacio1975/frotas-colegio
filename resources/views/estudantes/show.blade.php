@extends('layouts.app', ['page' => 'Detalhes do Estudante', 'pageSlug' => 'estudantes', 'section' => 'estudantes'])

@section('content')
    @include('alerts.error')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detalhes do Estudante</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>Nº</th>
                            <th>Nome</th>
                            <th>Idade</th>
                            <th>Sexo</th>
                            <th>Classe / Turno</th>
                            <th>Encarregado</th>
                            <th>Telefone</th>
                            <th>Estado</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $client->numero }}</td>
                                <td>{{ $client->nome }}</td>
                                <td>{{ $client->idade }}</td>
                                <td>{{ $client->sexo }}</td>
                                <td>{{ $client->classe }} / {{ $client->turno }} </td>
                                <td>{{ $client->nome_encarregado }} </td>
                                <td>{{ $client->telefone }}</td>
                                <td>{{ $client->email }}</td>
                                <td>
                                    @if (round(1) <= 0)
                                        <span class="text-success"> OK </span>
                                    @else
                                        <span class="text-danger"> Atraso </span>
                                    @endif
                                </td>
                                <td>{{ $client->pagamentos->count() }}</td>
                                <td>{{ format_money($client->transactions->sum('amount')) }}</td>
                                <td>{{ empty($client->pagamentos) ? date('d-m-y', strtotime($client->pagamentos->reverse()->first()->created_at)) : 'N/A' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Latest Transactions</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('estudantes.transactions.add', $client) }}"
                                class="btn btn-sm btn-primary">New Transaction</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Method</th>
                            <th>Amount</th>
                        </thead>
                        <tbody>
                            @foreach ($client->transactions->reverse()->take(25) as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ date('d-m-y', strtotime($transaction->created_at)) }}</td>
                                    <td><a
                                            href="{{ route('methods.show', $transaction->method) }}">{{ $transaction->method->name }}</a>
                                    </td>
                                    <td>{{ format_money($transaction->amount) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Latest Purchases</h4>
                        </div>
                        <div class="col-4 text-right">
                            <form method="post" action="{{ route('sales.store') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <button type="submit" class="btn btn-sm btn-primary">New Purchase</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Date</th>
                            <th>products</th>
                            <th>Stock</th>
                            <th>Total Amount</th>
                            <th>State</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($client->sales->reverse()->take(25) as $sale)
                                <tr>
                                    <td><a href="{{ route('sales.show', $sale) }}">{{ $sale->id }}</a></td>
                                    <td>{{ date('d-m-y', strtotime($sale->created_at)) }}</td>
                                    <td>{{ $sale->products->count() }}</td>
                                    <td>{{ $sale->products->sum('qty') }}</td>
                                    <td>{{ format_money($sale->products->sum('total_amount')) }}</td>
                                    <td>{{ $sale->finalized_at ? 'FINISHED' : 'ON HOLD' }}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{ route('sales.show', $sale) }}" class="btn btn-link"
                                            data-toggle="tooltip" data-placement="bottom" title="More Details">
                                            <i class="tim-icons icon-zoom-split"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
