@extends('layouts.app', ['page' => 'Viagens', 'pageSlug' => 'viagens', 'section' => 'viagens'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            <h4 class="card-title">Viagens</h4>
                            <a href="{{ route('viagens.create') }}" class="btn btn-sm btn-primary">Nova Viagem</a>
                        </div>
                        <div class="col-12">
                            <form action="{{ route('viagens.index') }}" method="get">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Viatura</label>
                                            <select name="viatura_id" class="form-control">
                                                <option value="">Todas as Viaturas</option>
                                                @foreach ($viaturas as $viatura)
                                                    <option value="{{ $viatura->id }}" {{ request('viatura_id') == $viatura->id ? 'selected' : '' }}>
                                                        {{ $viatura->modelo }} ({{ $viatura->matricula }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Período</label>
                                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label>&nbsp;</label>
                                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label>&nbsp;</label>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Filtrar</button>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Destino</th>
                                <th>Viatura</th>
                                <th>Rota</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viagens as $viagem)
                                <tr>
                                    <td>{{ $viagem->data_viagem->format('d/m/Y') }}</td>
                                    <td>{{ $viagem->rota->ponto_chegada }}</td>
                                    <td>{{ $viagem->viatura->modelo }} ({{ $viagem->viatura->matricula }})</td>
                                    <td>{{ $viagem->rota->nome }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
