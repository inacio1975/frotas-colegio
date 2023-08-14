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
                        <div class="col-12">
                            <form action="{{ route('viaturas.index') }}" method="GET" class="form-inline">
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
                        <table class="table tablesorter">
                            <thead class="text-primary">
                                <th>Matrícula</th>
                                {{-- <th>Marca</th> --}}
                                <th>Modelo</th>
                                <th>Capacidade</th>
                                <th>Número de Viagens</th>
                                <th>Valor A Pagar</th>
                                <!-- Outras colunas -->
                            </thead>
                            <tbody>
                                @foreach ($viaturas as $viatura)
                                    <tr>
                                        <td>{{ $viatura->matricula }}</td>
                                        {{-- <td>{{ $viatura->marca }}</td> --}}
                                        <td>{{ $viatura->modelo }}</td>
                                        <td>{{ $viatura->capacidade }}</td>
                                        <td>
                                            {{ $viatura->quantidade_viagens_mes }}
                                        </td>
                                        <td>{{ format_money($viatura->valor_a_pagar) }}</td> <!-- Número de viagens -->
                                        <!-- Restante das colunas -->
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
