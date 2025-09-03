<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 fw-bold">
                {{ __('Relatório de Clientes') }}
            </h2>
            <div class="btn-group">
                <a href="{{ route('relatorios.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Voltar
                </a>
                <button class="btn btn-primary" onclick="window.print()">
                    <i class="fas fa-print me-2"></i>Imprimir
                </button>
            </div>
        </div>
    </x-slot>

    <style>
        /* Design sofisticado para relatórios */
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
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
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: white;
        }
        
        .stat-icon.primary { background: #1e293b; }
        .stat-icon.success { background: #059669; }
        .stat-icon.warning { background: #d97706; }
        .stat-icon.info { background: #0891b2; }
        
        /* Tabela sofisticada */
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
        
        /* Filtros */
        .filter-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .form-control, .form-select {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #1e293b;
            box-shadow: 0 0 0 0.2rem rgba(30, 41, 59, 0.1);
        }
        
        /* Botões */
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
        
        .btn-primary {
            background: #1e293b;
            border-color: #1e293b;
        }
        
        .btn-primary:hover {
            background: #0f172a;
            border-color: #0f172a;
            box-shadow: 0 4px 12px rgba(30, 41, 59, 0.2);
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
        
        /* Badges */
        .badge {
            font-size: 0.75rem;
            padding: 0.4em 0.8em;
            font-weight: 500;
            border-radius: 6px;
        }
        
        .badge.bg-primary { background: #1e293b !important; }
        .badge.bg-success { background: #059669 !important; }
        
        /* Gráfico placeholder */
        .chart-placeholder {
            background: #f8fafc;
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 3rem;
            text-align: center;
            color: #6b7280;
        }
        
        /* Print styles */
        @media print {
            .btn, .filter-card { display: none !important; }
            .card { box-shadow: none !important; border: 1px solid #000 !important; }
        }
    </style>

    <div class="container-fluid py-4">
        <!-- Filtros -->
        <div class="filter-card">
            <h5 class="mb-3">
                <i class="fas fa-filter me-2"></i>Filtros
            </h5>
            <form method="GET" action="{{ route('relatorios.clientes') }}" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="nome" value="{{ request('nome') }}" 
                           class="form-control" placeholder="Ex: João Silva">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tipo</label>
                    <select name="tipo_cliente_id" class="form-select">
                        <option value="">Todos</option>
                        @foreach($tiposDisponiveis as $tipo)
                            <option value="{{ $tipo->id }}" {{ request('tipo_cliente_id') == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Cidade</label>
                    <input type="text" name="cidade" value="{{ request('cidade') }}" 
                           class="form-control" placeholder="Ex: São Paulo">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i>Filtrar
                    </button>
                </div>
            </form>
        </div>

        <!-- Estatísticas -->
        <div class="row g-4 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number text-primary">{{ $estatisticas['total'] ?? 0 }}</div>
                    <div class="stat-label">Total de Clientes</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon success">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="stat-number text-success">{{ $estatisticas['PF'] ?? 0 }}</div>
                    <div class="stat-label">Pessoa Física</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon warning">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-number text-warning">{{ $estatisticas['PJ'] ?? 0 }}</div>
                    <div class="stat-label">Pessoa Jurídica</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon info">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-number text-info">{{ $estatisticas['com_vendas'] ?? 0 }}</div>
                    <div class="stat-label">Com Vendas</div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Distribuição -->
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <i class="fas fa-chart-pie me-2"></i>Distribuição por Tipo
                        </h5>
                        <div style="position: relative; height: 300px;">
                            <canvas id="tipoChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i>Distribuição por Cidade
                        </h5>
                        <div style="position: relative; height: 300px;">
                            <canvas id="cidadeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de Clientes -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fas fa-list me-2"></i>Lista de Clientes
                </h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Tipo</th>
                                <th>Contato</th>
                                <th>Documento</th>
                                <th>Endereço</th>
                                <th>Vendas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clientes as $cliente)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                                 style="width: 40px; height: 40px;">
                                                <i class="fas fa-user text-muted"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $cliente->nome }}</div>
                                                <small class="text-muted">{{ $cliente->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            {{ $cliente->tipoCliente->codigo === 'PF' ? 'bg-primary' : 'bg-success' }}">
                                            {{ $cliente->tipoCliente->nome }}
                                        </span>
                                    </td>
                                    <td>
                                        <div>{{ $cliente->telefone }}</div>
                                        @if($cliente->celular)
                                            <small class="text-muted">{{ $cliente->celular }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($cliente->cpf)
                                            <div>{{ $cliente->cpf_formatado }}</div>
                                        @endif
                                        @if($cliente->rg)
                                            <small class="text-muted">{{ $cliente->rg }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div>{{ $cliente->endereco }}, {{ $cliente->numero }}</div>
                                        <small class="text-muted">{{ $cliente->cidade }}/{{ $cliente->estado }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $cliente->vendas->count() }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fas fa-users fa-2x mb-3 d-block"></i>
                                        Nenhum cliente encontrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Gráfico de distribuição por tipo
        const tipoData = {
            labels: ['Pessoa Física', 'Pessoa Jurídica'],
            datasets: [{
                data: [{{ $estatisticas['PF'] ?? 0 }}, {{ $estatisticas['PJ'] ?? 0 }}],
                backgroundColor: ['#1e293b', '#059669'],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        };

        const tipoConfig = {
            type: 'doughnut',
            data: tipoData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            font: {
                                size: 14,
                                weight: '500'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#e2e8f0',
                        borderWidth: 1,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((context.parsed / total) * 100).toFixed(1);
                                return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                            }
                        }
                    }
                },
                cutout: '60%',
                animation: {
                    animateRotate: true,
                    animateScale: true,
                    duration: 1000
                }
            }
        };

        // Gráfico de distribuição por cidade
        const cidadeData = {
            labels: [
                @foreach($cidadesData as $cidade)
                    '{{ $cidade->cidade }}',
                @endforeach
            ],
            datasets: [{
                label: 'Clientes',
                data: [
                    @foreach($cidadesData as $cidade)
                        {{ $cidade->total }},
                    @endforeach
                ],
                backgroundColor: [
                    '#1e293b',
                    '#059669',
                    '#d97706',
                    '#0891b2',
                    '#dc2626',
                    '#7c3aed'
                ],
                borderWidth: 1,
                borderColor: '#ffffff'
            }]
        };

        const cidadeConfig = {
            type: 'bar',
            data: cidadeData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#e2e8f0',
                        borderWidth: 1,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9'
                        },
                        ticks: {
                            color: '#6b7280',
                            font: {
                                size: 12
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6b7280',
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                animation: {
                    duration: 1000
                }
            }
        };

        // Criar os gráficos
        const tipoChart = new Chart(
            document.getElementById('tipoChart'),
            tipoConfig
        );

        const cidadeChart = new Chart(
            document.getElementById('cidadeChart'),
            cidadeConfig
        );
    </script>
</x-app-layout>
