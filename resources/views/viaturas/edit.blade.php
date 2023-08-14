@extends('layouts.app', ['page' => 'Editar Viatura', 'pageSlug' => 'viaturas', 'section' => 'viaturas'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Editar Viatura</h4>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('viaturas.update', $viatura) }}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Modelo</label>
                            <input type="text" name="modelo" class="form-control" placeholder="Modelo da Viatura" value="{{ old('modelo', $viatura->modelo) }}" required>
                            @include('alerts.feedback', ['field' => 'modelo'])
                        </div>
                        <div class="form-group">
                            <label>Matrícula</label>
                            <input type="text" name="matricula" class="form-control" placeholder="Matrícula da Viatura" value="{{ old('matricula', $viatura->matricula) }}" required oninput="this.value = this.value.toUpperCase();">
                            @include('alerts.feedback', ['field' => 'matricula'])
                        </div>
                        <div class="form-group">
                            <label>Capacidade</label>
                            <input type="number" name="capacidade" class="form-control" placeholder="Capacidade da Viatura" value="{{ old('capacidade', $viatura->capacidade) }}" required>
                            @include('alerts.feedback', ['field' => 'modelo'])
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
