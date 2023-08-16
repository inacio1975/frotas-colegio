@extends('layouts.app', ['page' => 'Facturas', 'pageSlug' => 'facturas', 'section' => 'facturas'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Facturas</h4>
                        </div>
                        <div class="col-12">
                            <form action="{{ route('facturas.index') }}" method="GET" class="form-inline">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group mr-2">
                                            <label for="inputMes" class="mr-2">Mês:</label>
                                            <select name="mes" id="inputMes" class="form-control">
                                                <option value="">Selecionar um mês</option>
                                                <option value="01" {{ $mesSelecionado == '01' ? 'selected' : '' }}>Janeiro</option>
                                                <option value="02" {{ $mesSelecionado == '02' ? 'selected' : '' }}>Fevereiro</option>
                                                <option value="03" {{ $mesSelecionado == '03' ? 'selected' : '' }}>Março</option>
                                                <option value="04" {{ $mesSelecionado == '04' ? 'selected' : '' }}>Abril</option>
                                                <option value="05" {{ $mesSelecionado == '05' ? 'selected' : '' }}>Maio</option>
                                                <option value="06" {{ $mesSelecionado == '06' ? 'selected' : '' }}>Junho</option>
                                                <option value="07" {{ $mesSelecionado == '07' ? 'selected' : '' }}>Julho</option>
                                                <option value="08" {{ $mesSelecionado == '08' ? 'selected' : '' }}>Agosto</option>
                                                <option value="09" {{ $mesSelecionado == '09' ? 'selected' : '' }}>Setembro</option>
                                                <option value="10" {{ $mesSelecionado == '10' ? 'selected' : '' }}>Outubro</option>
                                                <option value="11" {{ $mesSelecionado == '11' ? 'selected' : '' }}>Novembro</option>
                                                <option value="12" {{ $mesSelecionado == '12' ? 'selected' : '' }}>Dezembro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-primary ml-2">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter table-striped">
                            <thead class="text-primary">
                                <th>Estudante</th>
                                <th>Data de Emissão</th>
                                <th>Data de Vencimento</th>
                                <th>Valor da Factura</th>
                                <th>Estado</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($facturas as $factura)
                                    <tr>
                                        <td>{{ $factura->estudante->nome }}</td>
                                        <td>{{ $factura->data_emissao }}</td>
                                        <td>{{ $factura->data_vencimento }}</td>
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
                                        <!-- Restante das colunas -->

                                        {{-- <td class="td-actions text-right">
                                            <a href="{{ route('facturas.show', $factura) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Mais Detalhes">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            <a href="{{ route('facturas.edit', $viatura) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Editar Viatura">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('facturas.destroy', $viatura) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Eliminar Viatura" onclick="confirm('Estás seguro que queres eliminar este Viatura? Os registros de pagamentos não serão eliminados.') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </form>
                                        </td> --}}
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
