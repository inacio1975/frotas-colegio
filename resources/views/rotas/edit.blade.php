@extends('layouts.app', ['page' => 'Editar Rota', 'pageSlug' => 'rotas', 'section' => 'viaturas'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Editar Rota</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('rotas.update', $rota) }}" autocomplete="off">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                                    <label>Nome da Rota</label>
                                    <input type="text" name="nome" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" placeholder="Nome da Rota" value="{{ old('nome', $rota->nome) }}" required>
                                    @include('alerts.feedback', ['field' => 'nome'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('ponto_partida') ? ' has-danger' : '' }}">
                                    <label>Ponto de Partida</label>
                                    <input type="text" name="ponto_partida" class="form-control{{ $errors->has('ponto_partida') ? ' is-invalid' : '' }}" placeholder="Ponto de Partida" value="{{ old('ponto_partida', $rota->ponto_partida) }}" required>
                                    @include('alerts.feedback', ['field' => 'ponto_partida'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('ponto_chegada') ? ' has-danger' : '' }}">
                                    <label>Ponto de Chegada</label>
                                    <input type="text" name="ponto_chegada" class="form-control{{ $errors->has('ponto_chegada') ? ' is-invalid' : '' }}" placeholder="Ponto de Chegada" value="{{ old('ponto_chegada', $rota->ponto_chegada) }}" required>
                                    @include('alerts.feedback', ['field' => 'ponto_chegada'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('horario_partida') ? ' has-danger' : '' }}">
                                    <label>Horário de Partida</label>
                                    <input type="time" name="horario_partida" class="form-control{{ $errors->has('horario_partida') ? ' is-invalid' : '' }}" value="{{ old('horario_partida', $rota->horario_partida) }}" required>
                                    @include('alerts.feedback', ['field' => 'horario_partida'])
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('valor_a_pagar') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-valor_a_pagar">Custo da Rota</label>
                            <input type="number" name="valor_a_pagar" id="input-valor_a_pagar" class="form-control form-control-alternative{{ $errors->has('valor_a_pagar') ? ' is-invalid' : '' }}" value="{{ old('valor_a_pagar', $rota->valor_a_pagar) }}" required>
                            @include('alerts.feedback', ['field' => 'valor_a_pagar'])
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-fill btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
