@extends('layouts.app', ['page' => 'Adicionar Estudante', 'pageSlug' => 'estudantes', 'section' => 'estudantes'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Adicionar Estudante</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('estudantes.index') }}" class="btn btn-sm btn-primary">Ver Lista</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <form method="post" action="{{ route('estudantes.store') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Informação do Estudante</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Nome</label>
                                    <input type="text" name="nome" id="input-name" class="form-control form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}" placeholder="Nome do Estudante" value="{{ old('nome') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'nome'])
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-control-label" for="input-numero">Número</label>
                                        <input type="text" name="numero" id="input-numero" class="form-control form-control-alternative{{ $errors->has('numero') ? ' is-invalid' : '' }}" placeholder="Número de Estudante" value="{{ old('numero') }}" required>
                                        @include('alerts.feedback', ['field' => 'numero'])
                                    </div>
                                    <div class="col-2">
                                        <label class="form-control-label" for="input-idade">Idade</label>
                                        <input type="number" name="idade" id="input-idade" class="form-control form-control-alternative{{ $errors->has('idade') ? ' is-invalid' : '' }}" placeholder="Idade" value="{{ old('idade') }}" required>
                                        @include('alerts.feedback', ['field' => 'idade'])
                                    </div>
                                    <div class="col-2">
                                        <label class="form-control-label" for="input-sexo">Sexo</label>
                                        <select name="sexo" id="input-sexo" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required>
                                            <option value="">--</option>
                                            @foreach (['Masculino', 'Femenino'] as $sexo)
                                                @if($sexo == old('sexo'))
                                                    <option value="{{$sexo}}" selected>{{$sexo}}</option>
                                                @else
                                                    <option value="{{$sexo}}">{{$sexo}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label class="form-control-label" for="input-classe">Classe</label>
                                        <input type="text" name="classe" id="input-classe" class="form-control form-control-alternative{{ $errors->has('classe') ? ' is-invalid' : '' }}" placeholder="classe" value="{{ old('classe') }}" required>
                                        @include('alerts.feedback', ['field' => 'classe'])
                                    </div>
                                    <div class="col-2">
                                        <label class="form-control-label" for="input-turno">Turno</label>
                                        <select name="turno" id="input-turno" class="form-control form-control-alternative{{ $errors->has('turno') ? ' is-invalid' : '' }}" required>
                                            <option value="">--</option>
                                            @foreach (['Manhã', 'Tarde'] as $turno)
                                                @if($turno == old('turno'))
                                                    <option value="{{$turno}}" selected>{{$turno}}</option>
                                                @else
                                                    <option value="{{$turno}}">{{$turno}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('morada') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-morada">Morada</label>
                                    <input type="text" name="morada" id="input-morada" class="form-control form-control-alternative{{ $errors->has('morada') ? ' is-invalid' : '' }}" placeholder="Morada" value="{{ old('morada') }}" required>
                                    @include('alerts.feedback', ['field' => 'morada'])
                                </div>
                                <div class="form-group{{ $errors->has('nome_encarregado') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-nome_encarregado">Nome do Encarregado</label>
                                    <input type="text" name="nome_encarregado" id="input-nome_encarregado" class="form-control form-control-alternative{{ $errors->has('nome_encarregado') ? ' is-invalid' : '' }}" placeholder="Nome do nome_encarregado" value="{{ old('nome_encarregado') }}" required>
                                    @include('alerts.feedback', ['field' => 'nome_encarregado'])
                                </div>
                                <div class="form-group{{ $errors->has('telefone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-telefone">Telefone</label>
                                    <input type="text" name="telefone" id="input-telefone" class="form-control form-control-alternative{{ $errors->has('telefone') ? ' is-invalid' : '' }}" placeholder="Telefone do Encarregado" value="{{ old('telefone') }}" required>
                                    @include('alerts.feedback', ['field' => 'telefone'])
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
