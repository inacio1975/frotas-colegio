@extends('layouts.app', ['page' => 'Gerar Facturas', 'pageSlug' => 'gerar-facturas', 'section' => 'facturas'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Gerar Facturas</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('facturas.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="input_mes">Selecione o Mês</label>
                            <select name="mes" id="input_mes" class="form-control" required>
                                <option value="" disabled selected>Selecione o Mês</option>
                                <option value="01" {{ $mesSelecionado == '01' ? 'selected' : '' }}>Janeiro</option>
                                <option value="02" {{ $mesSelecionado == '02' ? 'selected' : '' }}>Fevereiro</option>
                                <option value="03" {{ $mesSelecionado == '03' ? 'selected' : '' }}>Março</option>
                                <option value="04" {{ $mesSelecionado == '04' ? 'selected' : '' }}>Abril</option>
                                <option value="05" {{ $mesSelecionado == '05' ? 'selected' : '' }}>Maio</option>
                                <option value="06" {{ $mesSelecionado == '06' ? 'selected' : '' }}>Junho</option>
                                <option value="07" {{ $mesSelecionado == '07' ? 'selected' : '' }}>Julho</option>
                                <option value="08" {{ $mesSelecionado == '08' ? 'selected' : '' }}>Agosto</option>
                                <option value="09" {{ $mesSelecionado == '09' ? 'selected' : '' }}>Setembro</option>
                                <option value="10" {{ $mesSelecionado == '10' ? 'selected' : '' }}>Outubro</option>
                                <option value="11" {{ $mesSelecionado == '11' ? 'selected' : '' }}>Novembro</option>
                                <option value="12" {{ $mesSelecionado == '12' ? 'selected' : '' }}>Dezembro</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Gerar Facturas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
