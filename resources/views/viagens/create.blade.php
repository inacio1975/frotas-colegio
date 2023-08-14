@extends('layouts.app', ['page' => 'Criar Viagem', 'pageSlug' => 'viagens-create', 'section' => 'viagens'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Criar Viagem</h4>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('viagens.store') }}">
                        @csrf

                        <div class="form-group">
                            <label>Data da Viagem</label>
                            <input type="date" name="data_viagem" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Destino</label>
                            <input type="text" name="destino" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Viatura</label>
                            <select name="viatura_id" class="form-control" required>
                                <option value="">Selecione uma Viatura</option>
                                @foreach ($viaturas as $viatura)
                                    <option value="{{ $viatura->id }}">{{ $viatura->modelo }} ({{ $viatura->placa }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Rota</label>
                            <select name="rota_id" class="form-control" required>
                                <option value="">Selecione uma Rota</option>
                                @foreach ($rotas as $rota)
                                    <option value="{{ $rota->id }}">{{ $rota->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">Criar Viagem</button>
                            <a href="{{ route('viagens.index') }}" class="btn btn-secondary mt-4">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
