<div class="sidebar">
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-bar-32"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#transactions" {{ $section == 'transactions' ? 'aria-expanded=true' : '' }}>
                    <i class="tim-icons icon-bank" ></i>
                    <span class="nav-link-text">Transações</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse {{ $section == 'transactions' ? 'show' : '' }}" id="transactions">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'tstats') class="active " @endif>
                            <a href="{{ route('transactions.stats')  }}">
                                <i class="tim-icons icon-chart-pie-36"></i>
                                <p>Estatísticas</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'transactions') class="active " @endif>
                            <a href="{{ route('transactions.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>Tudo</p>
                            </a>
                        </li>

                        <li @if ($pageSlug == 'expenses') class="active " @endif>
                            <a href="{{ route('transactions.type', ['type' => 'expense'])  }}">
                                <i class="tim-icons icon-coins"></i>
                                <p>Gastos</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'incomes') class="active " @endif>
                            <a href="{{ route('transactions.type', ['type' => 'income'])  }}">
                                <i class="tim-icons icon-credit-card"></i>
                                <p>Entradas</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'transfers') class="active " @endif>
                            <a href="{{ route('transfer.index')  }}">
                                <i class="tim-icons icon-send"></i>
                                <p>Reenbolsos</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'payments') class="active " @endif>
                            <a href="{{ route('transactions.type', ['type' => 'payment'])  }}">
                                <i class="tim-icons icon-money-coins"></i>
                                <p>Pagamentos</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <a data-toggle="collapse" href="#facturas" {{ $section == 'facturas' ? 'aria-expanded=true' : '' }}>
                    <i class="tim-icons icon-money-coins" ></i>
                    <span class="nav-link-text">Facturação</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse {{ $section == 'facturas' ? 'show' : '' }}" id="facturas">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'gerar-facturas') class="active " @endif>
                            <a href="{{ route('facturas.create')  }}">
                                <i class="tim-icons icon-chart-pie-36"></i>
                                <p>Gerar Factura</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'facturas') class="active " @endif>
                            <a href="{{ route('facturas.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>Ver Facturas</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <a data-toggle="collapse" href="#personal" {{ $section == 'personal' ? 'aria-expanded=true' : '' }}>
                    <i class="tim-icons icon-support-17"></i>
                    <span class="nav-link-text">Pessoal</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse {{ $section == 'personal' ? 'show' : '' }}" id="personal">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'personal-motoristas') class="active " @endif>
                            <a href="{{ route('pessoais.index', 'motorista') }}">
                                <i class="tim-icons icon-user-run"></i>
                                <p>Motoristas</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'personal-vigilantes') class="active " @endif>
                            <a href="{{ route('pessoais.index', 'vigilante') }}">
                                <i class="tim-icons icon-alert-circle-exc"></i>
                                <p>Vigilantes</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'personal-todos') class="active " @endif>
                            <a href="{{ route('pessoais.index') }}">
                                <i class="tim-icons icon-align-left-2"></i>
                                <p>Todos</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li @if ($pageSlug == 'viagens') class="active " @endif>
                <a href="{{ route('viagens.index') }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Viagens</p>
                </a>
            </li>

            <li>
                <a data-toggle="collapse" href="#estudantes" {{ $section == 'estudantes' ? 'aria-expanded=true' : '' }}>
                    <i class="tim-icons icon-single-02"></i>
                    <span class="nav-link-text">Estudantes</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse {{ $section == 'estudantes' ? 'show' : '' }}" id="estudantes">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'estudantes-todos') class="active " @endif>
                            <a href="{{ route('estudantes.index') }}">
                                <i class="tim-icons icon-align-left-2"></i>
                                <p>Todos</p>
                            </a>
                        </li>

                        <li @if ($pageSlug == 'estudantes-porpagar') class="active " @endif>
                            <a href="{{ route('estudantes.index', ['q' => 'porpagar']) }}">
                                <i class="tim-icons icon-user-run"></i>
                                <p>Facturas por Pagar</p>
                            </a>
                        </li>

                        <li @if ($pageSlug == 'estudantes-disabilitados') class="active " @endif>
                            <a href="{{ route('estudantes.index', ['q' => 'disabilitados']) }}">
                                <i class="tim-icons icon-alert-circle-exc"></i>
                                <p>Desabilitados</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            {{-- <li @if ($pageSlug == 'estudantes') class="active " @endif>
                <a href="{{ route('estudantes.index') }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Estudantes</p>
                </a>
            </li> --}}

            <li @if ($pageSlug == 'viaturas') class="active " @endif>
                <a href="{{ route('viaturas.index') }}">
                    <i class="tim-icons icon-bus-front-12"></i>
                    <p>Viaturas</p>
                </a>
            </li>

            <li @if ($pageSlug == 'rotas') class="active " @endif>
                <a href="{{ route('rotas.index') }}">
                    <i class="tim-icons icon-delivery-fast"></i>
                    <p>Rotas</p>
                </a>
            </li>

            <li @if ($pageSlug == 'methods') class="active " @endif>
                <a href="{{ route('methods.index') }}">
                    <i class="tim-icons icon-wallet-43"></i>
                    <p>Métodos e Contas</p>
                </a>
            </li>

            <li>
                <a data-toggle="collapse" href="#users" {{ $section == 'users' ? 'aria-expanded=true' : '' }}>
                    <i class="tim-icons icon-badge" ></i>
                    <span class="nav-link-text">Utilizadores</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse {{ $section == 'users' ? 'aria-expanded=true' : '' }}" id="users">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-badge"></i>
                                <p>Meu Perfil</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users-list') class="active " @endif>
                            <a href="{{ route('users.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>Gerir Utilizadores</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users-create') class="active " @endif>
                            <a href="{{ route('users.create')  }}">
                                <i class="tim-icons icon-simple-add"></i>
                                <p>Novo Utilizador</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
