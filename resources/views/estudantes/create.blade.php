@extends('layouts.app', ['page' => 'Adicionar Estudante', 'pageSlug' => 'estudantes', 'section' => 'estudantes'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Adicionar Estudante</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('estudantes.store') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('numero') ? ' has-danger' : '' }}">
                                    <label>Número</label>
                                    <input type="text" name="numero" class="form-control{{ $errors->has('numero') ? ' is-invalid' : '' }}" placeholder="Número de Estudante" value="{{ old('numero') }}" required>
                                    @include('alerts.feedback', ['field' => 'numero'])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                                    <label>Nome</label>
                                    <input type="text" name="nome" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" placeholder="Nome do Estudante" value="{{ old('nome') }}" required>
                                    @include('alerts.feedback', ['field' => 'nome'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('idade') ? ' has-danger' : '' }}">
                                    <label>Idade</label>
                                    <input type="number" name="idade" class="form-control{{ $errors->has('idade') ? ' is-invalid' : '' }}" placeholder="Idade" value="{{ old('idade') }}" required>
                                    @include('alerts.feedback', ['field' => 'idade'])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('sexo') ? ' has-danger' : '' }}">
                                    <label>Sexo</label>
                                    <select name="sexo" class="form-control{{ $errors->has('sexo') ? ' is-invalid' : '' }}" required>
                                        <option value="">-- Selecione --</option>
                                        <option value="Masculino" {{ old('sexo') === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="Feminino" {{ old('sexo') === 'Feminino' ? 'selected' : '' }}>Feminino</option>
                                    </select>
                                    @include('alerts.feedback', ['field' => 'sexo'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('classe') ? ' has-danger' : '' }}">
                                    <label>Classe</label>
                                    <input type="text" name="classe" class="form-control{{ $errors->has('classe') ? ' is-invalid' : '' }}" placeholder="Classe" value="{{ old('classe') }}" required>
                                    @include('alerts.feedback', ['field' => 'classe'])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('turno') ? ' has-danger' : '' }}">
                                    <label>Turno</label>
                                    <select name="turno" class="form-control{{ $errors->has('turno') ? ' is-invalid' : '' }}" required>
                                        <option value="">-- Selecione --</option>
                                        <option value="Manhã" {{ old('turno') === 'Manhã' ? 'selected' : '' }}>Manhã</option>
                                        <option value="Tarde" {{ old('turno') === 'Tarde' ? 'selected' : '' }}>Tarde</option>
                                    </select>
                                    @include('alerts.feedback', ['field' => 'turno'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('morada') ? ' has-danger' : '' }}">
                                    <label>Morada</label>
                                    <input type="text" name="morada" class="form-control{{ $errors->has('morada') ? ' is-invalid' : '' }}" placeholder="Morada" value="{{ old('morada') }}" required>
                                    @include('alerts.feedback', ['field' => 'morada'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('nome_encarregado') ? ' has-danger' : '' }}">
                                    <label>Nome do Encarregado</label>
                                    <input type="text" name="nome_encarregado" class="form-control{{ $errors->has('nome_encarregado') ? ' is-invalid' : '' }}" placeholder="Nome do Encarregado" value="{{ old('nome_encarregado') }}" required>
                                    @include('alerts.feedback', ['field' => 'nome_encarregado'])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('telefone') ? ' has-danger' : '' }}">
                                    <label>Telefone</label>
                                    <input type="text" name="telefone" class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }}" placeholder="Telefone do Encarregado" value="{{ old('telefone') }}" required>
                                    @include('alerts.feedback', ['field' => 'telefone'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('rota_id') ? ' has-danger' : '' }}">
                                    <label>Rota</label>
                                    <select name="rota_id" class="form-control{{ $errors->has('rota_id') ? ' is-invalid' : '' }}" required>
                                        <option value="">-- Selecione --</option>
                                        @foreach ($rotas as $rota)
                                            <option value="{{ $rota->id }}" {{ old('rota_id') === $rota->id ? 'selected' : '' }}>{{ $rota->nome }}</option>
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'rota_id'])
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-fill btn-primary">Adicionar Estudante</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
