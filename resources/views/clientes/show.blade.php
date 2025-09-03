<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 fw-bold">
                {{ __('Detalhes do Cliente') }}
            </h2>
        </div>
    </x-slot>

    <style>
        /* Design sofisticado para visualização */
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .card.bg-light {
            background: #f8fafc !important;
            border: 1px solid #e2e8f0;
        }
        
        /* Botões sofisticados */
        .btn {
            transition: all 0.3s ease;
            border-radius: 8px;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border: 1px solid transparent;
        }
        
        .btn:hover {
            transform: translateY(-1px);
        }
        
        .btn-warning {
            background: #d97706;
            border-color: #d97706;
        }
        
        .btn-warning:hover {
            background: #b45309;
            border-color: #b45309;
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.2);
        }
        
        .btn-secondary {
            background: #6b7280;
            border-color: #6b7280;
        }
        
        .btn-secondary:hover {
            background: #4b5563;
            border-color: #4b5563;
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.2);
        }
        
        /* Títulos de seção */
        .card-title {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e2e8f0;
        }
        
        /* Labels sofisticados */
        .form-label {
            color: #1e293b;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        /* Badges sofisticados */
        .badge {
            font-size: 0.875rem;
            padding: 0.5em 0.8em;
            font-weight: 500;
            border-radius: 6px;
        }
        
        .badge.bg-primary {
            background: #1e293b !important;
        }
        
        .badge.bg-success {
            background: #059669 !important;
        }
        
        /* Informações do cliente */
        .info-item {
            margin-bottom: 1rem;
        }
        
        .info-label {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }
        
        .info-value {
            color: #1e293b;
            font-weight: 500;
        }
        
        /* Estatísticas */
        .stat-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        /* Tabela de vendas */
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table thead th {
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            color: #1e293b;
            font-weight: 600;
            padding: 1rem;
        }
        
        .table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }
        
        .table tbody tr:hover {
            background-color: #f8fafc;
        }
        
        /* Ícones */
        .fas {
            color: #1e293b;
        }
        
        /* Botões de ação */
        .btn-group .btn {
            margin: 0 2px;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Cabeçalho com ações -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h5 mb-0 fw-bold">{{ $cliente->nome }}</h3>
                    <div class="btn-group" role="group">
                        <a href="{{ route('clientes.edit', $cliente) }}" 
                           class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Editar
                        </a>
                        <a href="{{ route('clientes.index') }}" 
                           class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Voltar
                        </a>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Informações Principais -->
                    <div class="col-lg-8">
                        <!-- Informações Básicas -->
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h4 class="card-title text-primary mb-4">
                                    <i class="fas fa-user me-2"></i>Informações Básicas
                                </h4>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Nome/Razão Social</label>
                                        <p class="mb-0">{{ $cliente->nome }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Tipo de Cliente</label>
                                        <div>
                                            <span class="badge fs-6 
                                                {{ $cliente->tipoCliente->codigo === 'PF' ? 'bg-primary' : 'bg-success' }}">
                                                {{ $cliente->tipoCliente->nome }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Email</label>
                                        <p class="mb-0">{{ $cliente->email }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Telefone</label>
                                        <p class="mb-0">{{ $cliente->telefone }}</p>
                                    </div>
                                    @if($cliente->celular)
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Celular</label>
                                            <p class="mb-0">{{ $cliente->celular }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Documentos -->
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h4 class="card-title text-primary mb-4">
                                    <i class="fas fa-id-card me-2"></i>Documentos
                                </h4>
                                
                                <div class="row g-3">
                                    @if($cliente->cpf)
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">CPF</label>
                                            <p class="mb-0">{{ $cliente->cpf_formatado }}</p>
                                        </div>
                                    @endif
                                    @if($cliente->rg)
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">RG</label>
                                            <p class="mb-0">{{ $cliente->rg }}</p>
                                        </div>
                                    @endif
                                    @if($cliente->data_nascimento)
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Data de Nascimento</label>
                                            <p class="mb-0">{{ $cliente->data_nascimento->format('d/m/Y') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Endereço -->
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h4 class="card-title text-primary mb-4">
                                    <i class="fas fa-map-marker-alt me-2"></i>Endereço
                                </h4>
                                
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Endereço Completo</label>
                                        <p class="mb-0">
                                            {{ $cliente->endereco }}, {{ $cliente->numero }}
                                            @if($cliente->complemento)
                                                - {{ $cliente->complemento }}
                                            @endif
                                        </p>
                                        <p class="mb-0">{{ $cliente->bairro }}</p>
                                        <p class="mb-0">{{ $cliente->cidade }}/{{ $cliente->estado }} - {{ $cliente->cep_formatado }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Observações -->
                        @if($cliente->observacoes)
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h4 class="card-title text-primary mb-4">
                                        <i class="fas fa-sticky-note me-2"></i>Observações
                                    </h4>
                                    <p class="mb-0">{{ $cliente->observacoes }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar com Estatísticas -->
                    <div class="col-lg-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h4 class="card-title text-primary mb-4">
                                    <i class="fas fa-chart-bar me-2"></i>Estatísticas
                                </h4>
                                
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center p-3 bg-white rounded">
                                            <div>
                                                <h6 class="mb-1">Total de Vendas</h6>
                                                <h4 class="mb-0 text-primary">{{ $cliente->vendas->count() }}</h4>
                                            </div>
                                            <i class="fas fa-handshake text-primary fs-3"></i>
                                        </div>
                                    </div>
                                    
                                    @if($cliente->vendas->count() > 0)
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-white rounded">
                                                <div>
                                                    <h6 class="mb-1">Valor Total</h6>
                                                    <h4 class="mb-0 text-success">
                                                        R$ {{ number_format($cliente->vendas->sum('valor_venda'), 2, ',', '.') }}
                                                    </h4>
                                                </div>
                                                <i class="fas fa-dollar-sign text-success fs-3"></i>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                @if($cliente->vendas->count() > 0)
                                    <div class="mt-4">
                                        <h6 class="fw-bold mb-3">Últimas Vendas</h6>
                                        <div class="list-group list-group-flush">
                                            @foreach($cliente->vendas->take(3) as $venda)
                                                <div class="list-group-item border-0 px-0">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h6 class="mb-1">{{ $venda->veiculo->marca }} {{ $venda->veiculo->modelo }}</h6>
                                                            <small class="text-muted">{{ $venda->data_venda->format('d/m/Y') }}</small>
                                                        </div>
                                                        <span class="badge bg-success">
                                                            R$ {{ number_format($venda->valor_venda, 2, ',', '.') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>