@extends('layouts.app', ['page' => 'Adicionar Viatura', 'pageSlug' => 'viaturas-create', 'section' => 'viaturas'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Adicionar Viatura</h4>
                </div>
                <div class="card-body">
                    @include('alerts.success')
                    <form method="post" action="{{ route('viaturas.store') }}" autocomplete="off">
                        @csrf

                        <h6 class="heading-small text-muted mb-4">Informações da Viatura</h6>
                        <div class="pl-lg-4">
                            {{-- <div class="form-group{{ $errors->has('marca') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-marca">Marca</label>
                                <input type="text" name="marca" id="input-marca" class="form-control{{ $errors->has('marca') ? ' is-invalid' : '' }}" placeholder="Marca" value="{{ old('marca') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'marca'])
                            </div> --}}
                            <div class="form-group{{ $errors->has('modelo') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-modelo">Modelo</label>
                                <input type="text" name="modelo" id="input-modelo" class="form-control{{ $errors->has('modelo') ? ' is-invalid' : '' }}" placeholder="Modelo" value="{{ old('modelo') }}" required>
                                @include('alerts.feedback', ['field' => 'modelo'])
                            </div>
                            {{-- <div class="form-group{{ $errors->has('ano') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-ano">Ano</label>
                                <input type="number" name="ano" id="input-ano" class="form-control{{ $errors->has('ano') ? ' is-invalid' : '' }}" placeholder="Ano" value="{{ old('ano') }}" required>
                                @include('alerts.feedback', ['field' => 'ano'])
                            </div> --}}
                            <div class="form-group{{ $errors->has('matricula') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-matricula">matricula</label>
                                <input type="text" name="matricula" id="input-matricula" class="form-control{{ $errors->has('matricula') ? ' is-invalid' : '' }}" placeholder="matricula" value="{{ old('matricula') }}" required>
                                @include('alerts.feedback', ['field' => 'matricula'])
                            </div>
                            <div class="form-group{{ $errors->has('capacidade') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-capacidade">Capacidade</label>
                                <input type="number" name="capacidade" id="input-capacidade" class="form-control{{ $errors->has('capacidade') ? ' is-invalid' : '' }}" placeholder="Capacidade" value="{{ old('capacidade') }}" required>
                                @include('alerts.feedback', ['field' => 'capacidade'])
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">Adicionar Viatura</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
