@extends('layouts.app', ['page' => 'Nova Transação', 'pageSlug' => 'estudantes', 'section' => 'estudantes'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Nova Transação</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('estudantes.show', $estudante) }}" class="btn btn-sm btn-primary">Voltar ao Estudante</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('transactions.store') }}" autocomplete="off">
                            @csrf
                            <input type="hidden" name="estudante_id" value="{{ $estudante->id }}">
                            <input type="hidden" name="factura_id" value="{{ $factura->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                            <h6 class="heading-small text-muted mb-4">Informação da Transação</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-method">Tipo de Transação</label>
                                    <select name="type" id="input-method"
                                        class="form-control form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                        required>
                                        @foreach (['income' => 'Pagamento recebido', 'expense' => 'Gastos'] as $type => $title)
                                            @if ($type == old('type'))
                                                <option value="{{ $type }}" selected>{{ $title }}</option>
                                            @else
                                                <option value="{{ $type }}">{{ $title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'payment_method_id'])
                                </div>
                                <div class="form-group{{ $errors->has('payment_method_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-method">Método de Pagamento</label>
                                    <select name="payment_method_id" id="input-method"
                                        class="form-select form-control-alternative{{ $errors->has('payment_method_id') ? ' is-invalid' : '' }}"
                                        required>
                                        @foreach ($payment_methods as $payment_method)
                                            @if ($payment_method['id'] == old('payment_method_id'))
                                                <option value="{{ $payment_method['id'] }}" selected>
                                                    {{ $payment_method['name'] }}</option>
                                            @else
                                                <option value="{{ $payment_method['id'] }}">{{ $payment_method['name'] }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'payment_method_id'])
                                </div>

                                <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-amount">Valor</label>
                                    <input type="number" step=".01" name="amount" id="input-amount" readonly
                                        class="form-control form-control-alternative" placeholder="Amount"
                                        value="{{ old('amount', $factura->data_vencimento->isPast() ? $factura->valor + $factura->valor * 0.10 : $factura->valor) }}" required>
                                    @include('alerts.feedback', ['field' => 'amount'])

                                </div>

                                <div class="form-group{{ $errors->has('reference') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-reference">Referência</label>
                                    <input type="text" name="reference" id="input-reference" readonly
                                        class="form-control form-control-alternative{{ $errors->has('reference') ? ' is-invalid' : '' }}"
                                        placeholder="Reference" value="{{ old('reference', $referencia) }}">
                                    @include('alerts.feedback', ['field' => 'reference'])
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
    </div>
@endsection

@push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        })
    </script>
@endpush('js')
