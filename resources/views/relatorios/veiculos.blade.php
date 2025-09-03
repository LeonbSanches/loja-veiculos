<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 fw-bold">
                {{ __('Relatório de Veículos') }}
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
        
        .badge.bg-success { background: #059669 !important; }
        .badge.bg-danger { background: #dc2626 !important; }
        .badge.bg-warning { background: #d97706 !important; }
        
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
            <form method="GET" action="{{ route('relatorios.veiculos') }}" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Marca</label>
                    <input type="text" name="marca" value="{{ request('marca') }}" 
                           class="form-control" placeholder="Ex: Toyota">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status_id" class="form-select">
                        <option value="">Todos</option>
                        @foreach($statusDisponiveis as $status)
                            <option value="{{ $status->id }}" {{ request('status_id') == $status->id ? 'selected' : '' }}>
                                {{ $status->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Ano Mínimo</label>
                    <input type="number" name="ano_min" value="{{ request('ano_min') }}" 
                           class="form-control" placeholder="Ex: 2020">
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
                        <i class="fas fa-car"></i>
                    </div>
                    <div class="stat-number text-primary">{{ $estatisticas['total'] ?? 0 }}</div>
                    <div class="stat-label">Total de Veículos</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-number text-success">{{ $estatisticas['disponivel'] ?? 0 }}</div>
                    <div class="stat-label">Disponíveis</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-number text-warning">{{ $estatisticas['reservado'] ?? 0 }}</div>
                    <div class="stat-label">Reservados</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon info">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-number text-info">R$ {{ number_format($valorTotalEstoque ?? 0, 2, ',', '.') }}</div>
                    <div class="stat-label">Valor do Estoque</div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Status -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <i class="fas fa-chart-pie me-2"></i>Distribuição por Status
                        </h5>
                        <div style="position: relative; height: 400px;">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de Veículos -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fas fa-list me-2"></i>Lista de Veículos
                </h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Veículo</th>
                                <th>Ano</th>
                                <th>KM</th>
                                <th>Preço</th>
                                <th>Status</th>
                                <th>Data Cadastro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($veiculos as $veiculo)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($veiculo->fotos->count() > 0)
                                                @php
                                                    $fotoPrincipal = $veiculo->fotos->where('principal', true)->first() ?? $veiculo->fotos->first();
                                                @endphp
                                                <img class="rounded-circle me-3" 
                                                     src="{{ Storage::url($fotoPrincipal->foto) }}" 
                                                     alt="{{ $veiculo->marca }} {{ $veiculo->modelo }}"
                                                     style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                                     style="width: 40px; height: 40px;">
                                                    <i class="fas fa-car text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold">{{ $veiculo->marca }} {{ $veiculo->modelo }}</div>
                                                <small class="text-muted">{{ $veiculo->versao }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $veiculo->ano_fab }}/{{ $veiculo->ano_modelo }}</td>
                                    <td>{{ number_format($veiculo->km, 0, ',', '.') }} km</td>
                                    <td class="fw-bold text-primary">
                                        R$ {{ number_format($veiculo->preco_venda, 2, ',', '.') }}
                                    </td>
                                    <td>
                                        <span class="badge 
                                            {{ $veiculo->status->codigo === 'disponivel' ? 'bg-success' : 
                                               ($veiculo->status->codigo === 'vendido' ? 'bg-danger' : 'bg-warning') }}">
                                            {{ $veiculo->status->nome }}
                                        </span>
                                    </td>
                                    <td>{{ $veiculo->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fas fa-search fa-2x mb-3 d-block"></i>
                                        Nenhum veículo encontrado.
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
        // Dados para o gráfico de status
        const statusData = {
            labels: [
                @foreach($statusDisponiveis as $status)
                    '{{ $status->nome }}',
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach($statusDisponiveis as $status)
                        {{ $estatisticas[$status->codigo] ?? 0 }},
                    @endforeach
                ],
                backgroundColor: [
                    '#1e293b',
                    '#059669', 
                    '#d97706',
                    '#0891b2',
                    '#dc2626',
                    '#7c3aed',
                    '#ea580c'
                ],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        };

        // Configuração do gráfico
        const statusConfig = {
            type: 'doughnut',
            data: statusData,
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
                        displayColors: true,
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

        // Criar o gráfico
        const statusChart = new Chart(
            document.getElementById('statusChart'),
            statusConfig
        );
    </script>
</x-app-layout>
