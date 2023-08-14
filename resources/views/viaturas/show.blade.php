@extends('layouts.app', ['page' => 'Detalhes da Viatura', 'pageSlug' => 'viaturas', 'section' => 'viaturas'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detalhes da Viatura</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Modelo</label>
                        <input type="text" class="form-control" value="{{ $viatura->modelo }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Matrícula</label>
                        <input type="text" class="form-control" value="{{ $viatura->matricula }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Capacidade</label>
                        <input type="number" class="form-control" value="{{ $viatura->capacidade }}" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Viagens do Mês</h4>
                </div>
                <div class="card-body">
                    <form method="get" action="{{ route('viaturas.show', $viatura) }}">
                        <div class="form-group">
                            <label>Mês</label>
                            <input type="month" name="month" class="form-control" value="{{ request('month') }}">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </form>
                    <ul class="list-group mt-4">
                        @foreach ($viagens as $viagem)
                            <li class="list-group-item">
                                {{ $viagem->data_viagem->format('d/m/Y') }} - {{ $viagem->destino }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <a href="{{ route('viaturas.edit', $viatura) }}" class="btn btn-primary">Editar Viatura</a>
            <a href="{{ route('viaturas.index') }}" class="btn btn-secondary">Voltar para a Lista</a>
        </div>
    </div>
@endsection
