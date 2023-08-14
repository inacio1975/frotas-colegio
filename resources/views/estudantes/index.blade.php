@extends('layouts.app', ['page' => 'Estudantes', 'pageSlug' => 'estudantes', 'section' => 'estudantes'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Estudantes</h4>
                        <a href="{{ route('estudantes.create') }}" class="btn btn-sm btn-primary">Adicionar Estudante</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="text-primary">
                                <tr>
                                    <th>Estudante</th>
                                    <th>Idade</th>
                                    <th>Sexo</th>
                                    <th>Classe / Turno</th>
                                    {{-- <th>Morada</th> --}}
                                    <th>Encarregado</th>
                                    <th>Telefone</th>
                                    <th>Estado</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudantes as $client)
                                    <tr>
                                        <td>{{ $client->nome }}<br>Nº {{ $client->numero }}</td>
                                        <td>{{ $client->idade }}</td>
                                        <td>{{ $client->sexo }}</td>
                                        <td>{{ $client->classe }} / {{ $client->turno }}</td>
                                        {{-- <td>{{ $client->morada }}</td> --}}
                                        <td>{{ $client->nome_encarregado }}</td>
                                        <td><a href="tel:{{ $client->telefone }}">{{ $client->telefone }}</a></td>
                                        <td>
                                            @if (round(1) <= 0)
                                                <span class="text-success"> OK </span>
                                            @else
                                                <span class="text-danger"> Atraso </span>
                                            @endif
                                        </td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('estudantes.show', $client) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Mais Detalhes">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            <a href="{{ route('estudantes.edit', $client) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Editar Estudante">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('estudantes.destroy', $client) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Eliminar Estudante" onclick="confirm('Estás seguro que queres eliminar este Estudante? Os registros de pagamentos não serão eliminados.') ? this.parentElement.submit() : ''">
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
                        {{-- {{ $estudantes->links() }} --}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
