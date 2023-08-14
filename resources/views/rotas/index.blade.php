@extends('layouts.app', ['page' => 'Rotas', 'pageSlug' => 'rotas', 'section' => 'rotas'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Rotas</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('rotas.create') }}" class="btn btn-sm btn-primary">Adicionar Rota</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th>Nome da Rota</th>
                                <th>Ponto de Partida</th>
                                <th>Ponto de Chegada</th>
                                <th>Horário de Partida</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($rotas as $rota)
                                    <tr>
                                        <td>{{ $rota->nome }}</td>
                                        <td>{{ $rota->ponto_partida }}</td>
                                        <td>{{ $rota->ponto_chegada }}</td>
                                        <td>{{ $rota->horario_partida }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('rotas.show', $rota) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Mais Detalhes">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            <a href="{{ route('rotas.edit', $rota) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Editar Rota">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('rotas.destroy', $rota) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Eliminar Rota" onclick="confirm('Estás seguro que queres eliminar esta Rota?') ? this.parentElement.submit() : ''">
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
                        {{-- Paginação aqui, se necessário --}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
