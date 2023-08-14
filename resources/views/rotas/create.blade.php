@extends('layouts.app', ['page' => 'Adicionar Rota', 'pageSlug' => 'rotas', 'section' => 'rotas'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Rota</div>

                <div class="card-body">
                    <form method="post" action="{{ route('rotas.store') }}" autocomplete="off">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">Informações da Rota</h6>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-nome">Nome da Rota</label>
                                <input type="text" name="nome" id="input-nome" class="form-control form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}" placeholder="Nome da Rota" value="{{ old('nome') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'nome'])
                            </div>
                            <div class="form-group{{ $errors->has('ponto_partida') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-ponto_partida">Ponto de Partida</label>
                                <input type="text" name="ponto_partida" id="input-ponto_partida" class="form-control form-control-alternative{{ $errors->has('ponto_partida') ? ' is-invalid' : '' }}" placeholder="Ponto de Partida" value="{{ old('ponto_partida') }}" required>
                                @include('alerts.feedback', ['field' => 'ponto_partida'])
                            </div>
                            <div class="form-group{{ $errors->has('ponto_chegada') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-ponto_chegada">Ponto de Chegada</label>
                                <input type="text" name="ponto_chegada" id="input-ponto_chegada" class="form-control form-control-alternative{{ $errors->has('ponto_chegada') ? ' is-invalid' : '' }}" placeholder="Ponto de Chegada" value="{{ old('ponto_chegada') }}" required>
                                @include('alerts.feedback', ['field' => 'ponto_chegada'])
                            </div>
                            <div class="form-group{{ $errors->has('horario_partida') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-horario_partida">Horário de Partida</label>
                                <input type="time" name="horario_partida" id="input-horario_partida" class="form-control form-control-alternative{{ $errors->has('horario_partida') ? ' is-invalid' : '' }}" value="{{ old('horario_partida') }}" required>
                                @include('alerts.feedback', ['field' => 'horario_partida'])
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">Adicionar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
