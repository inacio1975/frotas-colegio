@extends('layouts.app', ['page' => 'Viaturas', 'pageSlug' => 'viaturas', 'section' => 'viaturas'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Viaturas</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('viaturas.create') }}" class="btn btn-sm btn-primary">Adicionar Viatura</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                {{-- <th>Marca</th> --}}
                                <th>Modelo</th>
                                {{-- <th>Ano</th> --}}
                                <th>Matricula</th>
                                <th>Capacidade</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($viaturas as $viatura)
                                    <tr>
                                        {{-- <td>{{ $viatura->marca }}</td> --}}
                                        <td>{{ $viatura->modelo }}</td>
                                        {{-- <td>{{ $viatura->ano }}</td> --}}
                                        <td>{{ $viatura->matricula }}</td>
                                        <td>{{ $viatura->capacidade }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('viaturas.show', $viatura) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Ver Detalhes">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            <a href="{{ route('viaturas.edit', $viatura) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Editar Viatura">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('viaturas.destroy', $viatura) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Eliminar Viatura" onclick="confirm('Tem certeza de que deseja excluir esta Viatura?') ? this.parentElement.submit() : ''">
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
            </div>
        </div>
    </div>
@endsection
