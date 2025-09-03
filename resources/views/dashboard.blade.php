<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <div class="bg-light rounded-circle p-2">
                        <i class="fas fa-chart-line text-dark" style="font-size: 1.2rem;"></i>
                    </div>
                </div>
                <div>
                    <h2 class="h5 mb-0 fw-semibold text-dark">
                        {{ __('Dashboard') }}
                    </h2>
                    <small class="text-muted">Visão geral do sistema</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end">
                    <div class="text-muted small">{{ now()->format('d/m/Y') }}</div>
                    <div class="text-dark small fw-medium">{{ now()->format('H:i') }}</div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="bg-success rounded-circle me-2" style="width: 8px; height: 8px;"></div>
                    <span class="text-muted small">Online</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid py-4">
        <!-- Cards de Estatísticas -->
        <div class="row g-4 mb-4">
            <!-- Veículos Disponíveis -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 dashboard-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-success rounded-circle p-3">
                                    <i class="fas fa-car text-white fs-5"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="card-title text-muted mb-1">Veículos Disponíveis</h6>
                                <h3 class="mb-0 fw-bold text-dark">{{ $veiculosDisponiveis ?? 0 }}</h3>
                                <small class="text-muted">
                                    Prontos para venda
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total de Clientes -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 dashboard-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-primary rounded-circle p-3">
                                    <i class="fas fa-users text-white fs-5"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="card-title text-muted mb-1">Total de Clientes</h6>
                                <h3 class="mb-0 fw-bold text-dark">{{ $totalClientes ?? 0 }}</h3>
                                <small class="text-muted">
                                    Cadastrados no sistema
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vendas do Mês -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 dashboard-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-warning rounded-circle p-3">
                                    <i class="fas fa-chart-line text-white fs-5"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="card-title text-muted mb-1">Vendas do Mês</h6>
                                <h3 class="mb-0 fw-bold text-dark">{{ $vendasMes ?? 0 }}</h3>
                                <small class="text-muted">
                                    {{ now()->format('M/Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Faturamento -->
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 dashboard-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-info rounded-circle p-3">
                                    <i class="fas fa-dollar-sign text-white fs-5"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="card-title text-muted mb-1">Faturamento</h6>
                                <h3 class="mb-0 fw-bold text-dark">R$ {{ number_format($faturamentoMes ?? 0, 2, ',', '.') }}</h3>
                                <small class="text-muted">
                                    Este mês
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards de Ações Rápidas -->
        <div class="row g-4 mb-4">
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 action-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-dark">
                            <i class="fas fa-car me-2 text-primary"></i>Veículos
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('veiculos.index') }}" 
                               class="btn btn-outline-primary">
                                <i class="fas fa-list me-2"></i>Gerenciar Veículos
                            </a>
                            <a href="{{ route('veiculos.create') }}" 
                               class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Novo Veículo
                            </a>
                            <a href="{{ route('veiculos.dashboard') }}" 
                               class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-chart-bar me-1"></i>Relatórios
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 action-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-dark">
                            <i class="fas fa-users me-2 text-success"></i>Clientes
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('clientes.index') }}" 
                               class="btn btn-outline-success">
                                <i class="fas fa-list me-2"></i>Gerenciar Clientes
                            </a>
                            <a href="{{ route('clientes.create') }}" 
                               class="btn btn-success">
                                <i class="fas fa-user-plus me-2"></i>Novo Cliente
                            </a>
                            <a href="{{ route('clientes.dashboard') }}" 
                               class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-chart-bar me-1"></i>Relatórios
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 action-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-dark">
                            <i class="fas fa-handshake me-2 text-warning"></i>Vendas
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('vendas.index') }}" 
                               class="btn btn-outline-warning">
                                <i class="fas fa-list me-2"></i>Gerenciar Vendas
                            </a>
                            <a href="{{ route('vendas.create') }}" 
                               class="btn btn-warning">
                                <i class="fas fa-plus me-2"></i>Nova Venda
                            </a>
                            <a href="{{ route('vendas.dashboard') }}" 
                               class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-chart-bar me-1"></i>Relatórios
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Veículos e Clientes Recentes -->
        <div class="row g-4">
            <!-- Veículos Recentes -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100 recent-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-dark mb-0">
                                <i class="fas fa-car me-2 text-primary"></i>Veículos Recentes
                            </h5>
                            <a href="{{ route('veiculos.index') }}" class="btn btn-sm btn-outline-secondary">
                                Ver Todos
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(isset($veiculosRecentes) && $veiculosRecentes->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($veiculosRecentes as $veiculo)
                                    <div class="list-group-item border-0 px-0 py-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 fw-semibold">
                                                    {{ $veiculo->marca }} {{ $veiculo->modelo }}
                                                </h6>
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar me-1"></i>
                                                    {{ $veiculo->ano_fab }}/{{ $veiculo->ano_modelo }}
                                                    <span class="mx-2">•</span>
                                                    <i class="fas fa-tachometer-alt me-1"></i>
                                                    {{ number_format($veiculo->km, 0, ',', '.') }}km
                                                </small>
                                            </div>
                                            <div class="text-end">
                                                <div class="fw-bold text-success">
                                                    R$ {{ number_format($veiculo->preco_venda, 2, ',', '.') }}
                                                </div>
                                                <span class="badge bg-primary">
                                                    {{ $veiculo->status->nome ?? 'N/A' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-car text-muted mb-3" style="font-size: 3rem;"></i>
                                <p class="text-muted">Nenhum veículo cadastrado ainda.</p>
                                <a href="{{ route('veiculos.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Cadastrar Primeiro Veículo
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Clientes Recentes -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100 recent-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-dark mb-0">
                                <i class="fas fa-users me-2 text-success"></i>Clientes Recentes
                            </h5>
                            <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-outline-secondary">
                                Ver Todos
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(isset($clientesRecentes) && $clientesRecentes->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($clientesRecentes as $cliente)
                                    <div class="list-group-item border-0 px-0 py-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 fw-semibold">{{ $cliente->nome }}</h6>
                                                <small class="text-muted">
                                                    <i class="fas fa-envelope me-1"></i>
                                                    {{ $cliente->email }}
                                                    @if($cliente->telefone)
                                                        <span class="mx-2">•</span>
                                                        <i class="fas fa-phone me-1"></i>
                                                        {{ $cliente->telefone }}
                                                    @endif
                                                </small>
                                            </div>
                                            <div class="text-end">
                                                <span class="badge 
                                                    {{ $cliente->tipoCliente->codigo === 'PF' ? 'bg-primary' : 'bg-success' }}">
                                                    {{ $cliente->tipoCliente->nome }}
                                                </span>
                                                <div class="small text-muted mt-1">
                                                    {{ $cliente->created_at->format('d/m/Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-users text-muted mb-3" style="font-size: 3rem;"></i>
                                <p class="text-muted">Nenhum cliente cadastrado ainda.</p>
                                <a href="{{ route('clientes.create') }}" class="btn btn-success">
                                    <i class="fas fa-user-plus me-2"></i>Cadastrar Primeiro Cliente
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Reset e base */
        body {
            background-color: #f8fafc;
        }
        
        /* Cards principais */
        .dashboard-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
        }
        
        .dashboard-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08) !important;
            border-color: #cbd5e1;
        }
        
        /* Cards de ação */
        .action-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
        }
        
        .action-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.06) !important;
            border-color: #cbd5e1;
        }
        
        .action-card .card-header {
            border-radius: 12px 12px 0 0 !important;
            border: none;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        
        /* Cards recentes */
        .recent-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
        }
        
        .recent-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.06) !important;
            border-color: #cbd5e1;
        }
        
        .recent-card .card-header {
            border-radius: 12px 12px 0 0 !important;
            border: none;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        
        /* Cores sofisticadas */
        .bg-primary {
            background: #1e293b !important;
        }
        
        .bg-success {
            background: #059669 !important;
        }
        
        .bg-warning {
            background: #d97706 !important;
        }
        
        .bg-info {
            background: #0891b2 !important;
        }
        
        /* Ícones dos cards de estatísticas - cores sólidas */
        .dashboard-card .bg-success {
            background: #059669 !important;
        }
        
        .dashboard-card .bg-primary {
            background: #1e293b !important;
        }
        
        .dashboard-card .bg-warning {
            background: #d97706 !important;
        }
        
        .dashboard-card .bg-info {
            background: #0891b2 !important;
        }
        
        /* Botões sofisticados */
        .btn {
            transition: all 0.3s ease;
            border-radius: 8px;
            font-weight: 500;
            border: 1px solid transparent;
        }
        
        .btn:hover {
            transform: translateY(-1px);
        }
        
        .btn-primary {
            background: #1e293b;
            border-color: #1e293b;
        }
        
        .btn-primary:hover {
            background: #0f172a;
            border-color: #0f172a;
        }
        
        .btn-success {
            background: #059669;
            border-color: #059669;
        }
        
        .btn-success:hover {
            background: #047857;
            border-color: #047857;
        }
        
        .btn-warning {
            background: #d97706;
            border-color: #d97706;
        }
        
        .btn-warning:hover {
            background: #b45309;
            border-color: #b45309;
        }
        
        .btn-danger {
            background: #dc2626;
            border-color: #dc2626;
        }
        
        .btn-danger:hover {
            background: #b91c1c;
            border-color: #b91c1c;
        }
        
        .btn-info {
            background: #0891b2;
            border-color: #0891b2;
        }
        
        .btn-info:hover {
            background: #0e7490;
            border-color: #0e7490;
        }
        
        /* Botões outline */
        .btn-outline-primary {
            border-color: #1e293b;
            color: #1e293b;
            background: transparent;
        }
        
        .btn-outline-primary:hover {
            background-color: #1e293b;
            border-color: #1e293b;
        }
        
        .btn-outline-success {
            border-color: #059669;
            color: #059669;
            background: transparent;
        }
        
        .btn-outline-success:hover {
            background-color: #059669;
            border-color: #059669;
        }
        
        .btn-outline-warning {
            border-color: #d97706;
            color: #d97706;
            background: transparent;
        }
        
        .btn-outline-warning:hover {
            background-color: #d97706;
            border-color: #d97706;
        }
        
        .btn-outline-info {
            border-color: #0891b2;
            color: #0891b2;
            background: transparent;
        }
        
        .btn-outline-info:hover {
            background-color: #0891b2;
            border-color: #0891b2;
        }
        
        /* Lista de itens */
        .list-group-item {
            transition: all 0.2s ease;
            border: none;
        }
        
        .list-group-item:hover {
            background-color: #f8fafc;
        }
        
        /* Badges */
        .badge {
            font-size: 0.75rem;
            padding: 0.4em 0.8em;
            font-weight: 500;
        }
        
        .badge.bg-primary {
            background: #1e293b !important;
        }
        
        .badge.bg-success {
            background: #059669 !important;
        }
        
        .badge.bg-warning {
            background: #d97706 !important;
        }
        
        .badge.bg-info {
            background: #0891b2 !important;
        }
        
        /* Cores de texto */
        .text-success {
            color: #059669 !important;
        }
        
        .text-primary {
            color: #1e293b !important;
        }
        
        .text-warning {
            color: #d97706 !important;
        }
        
        .text-info {
            color: #0891b2 !important;
        }
        
        /* Header do dashboard */
        .card-title {
            color: #1e293b;
            font-weight: 600;
        }
        
        /* Animações suaves */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .dashboard-card,
        .action-card,
        .recent-card {
            animation: fadeInUp 0.5s ease-out;
        }
        
        .dashboard-card:nth-child(1) { animation-delay: 0.1s; }
        .dashboard-card:nth-child(2) { animation-delay: 0.15s; }
        .dashboard-card:nth-child(3) { animation-delay: 0.2s; }
        .dashboard-card:nth-child(4) { animation-delay: 0.25s; }
        
        .action-card:nth-child(1) { animation-delay: 0.3s; }
        .action-card:nth-child(2) { animation-delay: 0.35s; }
        .action-card:nth-child(3) { animation-delay: 0.4s; }
        
        .recent-card:nth-child(1) { animation-delay: 0.45s; }
        .recent-card:nth-child(2) { animation-delay: 0.5s; }
        
        /* Melhorias gerais */
        .card-body {
            padding: 1.5rem;
        }
        
        .card-header {
            padding: 1rem 1.5rem;
        }
        
        h3 {
            font-weight: 700;
            color: #1e293b;
        }
        
        h6 {
            font-weight: 600;
            color: #64748b;
        }
        
        small {
            color: #64748b;
        }
        
        .text-muted {
            color: #64748b !important;
        }
    </style>
</x-app-layout>