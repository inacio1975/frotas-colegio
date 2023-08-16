@extends('layouts.app', ['page' => 'Editar Estudante', 'pageSlug' => 'estudantes-edit', 'section' => 'estudantes'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Editar Estudante</h4>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('estudantes.update', $estudante) }}">
                        @csrf
                        @method('put')

                        <h6 class="heading-small text-muted mb-4">Informação do Estudante</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('Status') }}</label>
                                        <select name="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                            <option value="1" {{ old('status', $estudante->status) == '1' ? 'selected' : '' }}>{{ __('Habilitado') }}</option>
                                            <option value="0" {{ old('status', $estudante->status) == '0' ? 'selected' : '' }}>{{ __('Desabilitado') }}</option>
                                        </select>
                                        @include('alerts.feedback', ['field' => 'status'])
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="input-nome">Nome</label>
                                <input type="text" name="nome" id="input-nome" class="form-control form-control-alternative" placeholder="Nome do Estudante" value="{{ old('nome', $estudante->nome) }}" required>
                                @include('alerts.feedback', ['field' => 'nome'])
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="form-control-label" for="input-numero">Número</label>
                                    <input type="text" name="numero" id="input-numero" class="form-control form-control-alternative" placeholder="Número de Estudante" value="{{ old('numero', $estudante->numero) }}" required>
                                @include('alerts.feedback', ['field' => 'numero'])

                                </div>
                                <div class="col-2">
                                    <label class="form-control-label" for="input-idade">Idade</label>
                                    <input type="number" name="idade" id="input-idade" class="form-control form-control-alternative" placeholder="Idade" value="{{ old('idade', $estudante->idade) }}" required>
                                @include('alerts.feedback', ['field' => 'idade'])

                                </div>
                                <div class="col-2">
                                    <label class="form-control-label" for="input-sexo">Sexo</label>
                                    <select name="sexo" id="input-sexo" class="form-control form-control-alternative" required>
                                        <option value="Masculino" {{ $estudante->sexo === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="Feminino" {{ $estudante->sexo === 'Feminino' ? 'selected' : '' }}>Feminino</option>
                                    </select>
                                @include('alerts.feedback', ['field' => 'sexo'])

                                </div>
                                <div class="col-2">
                                    <label class="form-control-label" for="input-classe">Classe</label>
                                    <input type="text" name="classe" id="input-classe" class="form-control form-control-alternative" placeholder="Classe" value="{{ old('classe', $estudante->classe) }}" required>
                                @include('alerts.feedback', ['field' => 'classe'])

                                </div>
                                <div class="col-2">
                                    <label class="form-control-label" for="input-turno">Turno</label>
                                    <select name="turno" id="input-turno" class="form-control form-control-alternative" required>
                                        <option value="Manhã" {{ $estudante->turno === 'Manhã' ? 'selected' : '' }}>Manhã</option>
                                        <option value="Tarde" {{ $estudante->turno === 'Tarde' ? 'selected' : '' }}>Tarde</option>
                                    </select>
                                @include('alerts.feedback', ['field' => 'turno'])

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="input-morada">Morada</label>
                                <input type="text" name="morada" id="input-morada" class="form-control form-control-alternative" placeholder="Morada" value="{{ old('morada', $estudante->morada) }}" required>
                                @include('alerts.feedback', ['field' => 'morada'])

                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="input-nome_encarregado">Nome do Encarregado</label>
                                <input type="text" name="nome_encarregado" id="input-nome_encarregado" class="form-control form-control-alternative" placeholder="Nome do Encarregado" value="{{ old('nome_encarregado', $estudante->nome_encarregado) }}" required>
                                @include('alerts.feedback', ['field' => 'nome_encarregado'])

                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="input-telefone">Telefone</label>
                                <input type="text" name="telefone" id="input-telefone" class="form-control form-control-alternative" placeholder="Telefone do Encarregado" value="{{ old('telefone', $estudante->telefone) }}" required>
                                @include('alerts.feedback', ['field' => 'telefone'])

                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="input-rota_id">Rota</label>
                                <select name="rota_id" id="input-rota_id" class="form-control form-control-alternative" required>
                                    <option value="">Selecione a Rota</option>
                                    @foreach ($rotas as $rota)
                                        <option value="{{ $rota->id }}" {{ $rota->id == $estudante->rota_id ? 'selected' : '' }}>{{ $rota->nome }}</option>
                                    @endforeach
                                </select>
                                @include('alerts.feedback', ['field' => 'rota_id'])

                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
