@extends('layouts.app', ['page' => 'Estudantes', 'pageSlug' => 'estudantes', 'section' => 'estudantes'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Estudantes</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('estudantes.create') }}" class="btn btn-sm btn-primary">Add Estudante</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th>Estudante</th>
                                <th>Idade</th>
                                <th>Sexo</th>
                                <th>Classe / Turno</th>
                                <th>Morada</th>
                                <th>Encarregado</th>
                                <th>Telefone</th>
                                <th>Estado</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($estudantes as $client)
                                    <tr>
                                        <td>{{ $client->nome }}<br>Nº-{{ $client->numero }}</td>
                                        <td> {{ $client->idade }} </td>
                                        <td>{{ $client->sexo }} </td>
                                        <td>{{ $client->classe }} - {{ $client->turno }} </td>
                                        <td>{{ $client->morada }} </td>
                                        <td>{{ $client->encarregado }} </td>
                                        <td><a href="tel:{{ $client->telefone }}">{{ $client->telefone }}</a></td>
                                        <td>
                                            @if (round($client->atrasos) <= 0)
                                                <span class="text-success"> OK </span>
                                            @else
                                                <span class="text-danger"> Atraso </span>
                                            @endif
                                        </td>
                                        <td>{{ ($client->pagamentos->sortByDesc('created_at')->first()) ? date('d-m-y', strtotime($client->pagamentos->sortByDesc('created_at')->first()->created_at)) : 'N/A' }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('estudantes.show', $client) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="More Details">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            <a href="{{ route('estudantes.edit', $client) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Client">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('estudantes.destroy', $client) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Client" onclick="confirm('Estás seguro que quieres eliminar a este Client? Los registros de sus compras y Transactions no serán eliminados.') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $estudantes->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
