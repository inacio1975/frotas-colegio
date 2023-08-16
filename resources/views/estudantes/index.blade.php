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
                                @foreach ($estudantes as $estudante)
                                    <tr>
                                        <td>{{ $estudante->nome }}<br>Nº {{ $estudante->numero }}</td>
                                        <td>{{ $estudante->idade }}</td>
                                        <td>{{ $estudante->sexo }}</td>
                                        <td>{{ $estudante->classe }} / {{ $estudante->turno }}</td>
                                        {{-- <td>{{ $estudante->morada }}</td> --}}
                                        <td>{{ $estudante->nome_encarregado }}</td>
                                        <td><a href="tel:{{ $estudante->telefone }}">{{ $estudante->telefone }}</a></td>
                                        <td>
                                            @if ($estudante->faturasAtraso > 0)
                                                <span class="text-danger">Em Atraso (
                                                    @if ($estudante->faturasAtraso > 0)
                                                        <span class="text-danger">{{ $estudante->faturasAtraso }}
                                                            Fatura(s)</span>
                                                    @endif
                                                    )
                                                </span>
                                            @else
                                                <span class="text-success">Em Dia</span>
                                            @endif
                                        </td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('estudantes.show', $estudante) }}" class="btn btn-link"
                                                data-toggle="tooltip" data-placement="bottom" title="Mais Detalhes">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            <a href="{{ route('estudantes.edit', $estudante) }}" class="btn btn-link"
                                                data-toggle="tooltip" data-placement="bottom" title="Editar Estudante">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('estudantes.destroy', $estudante) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip"
                                                    data-placement="bottom" title="Eliminar Estudante"
                                                    onclick="confirm('Estás seguro que queres eliminar este Estudante? Os registros de pagamentos não serão eliminados.') ? this.parentElement.submit() : ''">
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
