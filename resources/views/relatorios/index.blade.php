<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 fw-bold">
                {{ __('Relatórios') }}
            </h2>
        </div>
    </x-slot>

    <style>
        /* Design sofisticado para relatórios */
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }
        
        .report-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .report-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.1);
            border-color: #1e293b;
        }
        
        .report-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
        }
        
        .report-icon.veiculos {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        }
        
        .report-icon.clientes {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        }
        
        .report-icon.vendas {
            background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
        }
        
        .report-title {
            color: #1e293b;
            font-weight: 600;
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }
        
        .report-description {
            color: #6b7280;
            font-size: 0.95rem;
            line-height: 1.5;
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
        
        .btn-primary {
            background: #1e293b;
            border-color: #1e293b;
        }
        
        .btn-primary:hover {
            background: #0f172a;
            border-color: #0f172a;
            box-shadow: 0 4px 12px rgba(30, 41, 59, 0.2);
        }
        
        .btn-success {
            background: #059669;
            border-color: #059669;
        }
        
        .btn-success:hover {
            background: #047857;
            border-color: #047857;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2);
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
        
        /* Header sofisticado */
        .page-header {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
        }
        
        .page-title {
            color: #1e293b;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .page-subtitle {
            color: #6b7280;
            font-size: 1.1rem;
        }
        
        /* Animações */
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
        
        .report-card {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .report-card:nth-child(1) { animation-delay: 0.1s; }
        .report-card:nth-child(2) { animation-delay: 0.2s; }
        .report-card:nth-child(3) { animation-delay: 0.3s; }
    </style>

    <div class="container-fluid py-4">
        <!-- Header da página -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-chart-bar me-3"></i>Relatórios
            </h1>
            <p class="page-subtitle mb-0">
                Acesse relatórios detalhados sobre veículos, clientes e vendas
            </p>
        </div>

        <!-- Cards de relatórios -->
        <div class="row g-4">
            <!-- Relatório de Veículos -->
            <div class="col-lg-4 col-md-6">
                <div class="report-card" onclick="window.location.href='{{ route('relatorios.veiculos') }}'">
                    <div class="report-icon veiculos">
                        <i class="fas fa-car"></i>
                    </div>
                    <h3 class="report-title">Relatório de Veículos</h3>
                    <p class="report-description">
                        Análise completa do estoque de veículos, status, marcas, modelos e estatísticas de vendas.
                    </p>
                    <div class="mt-3">
                        <span class="badge bg-primary">Estoque</span>
                        <span class="badge bg-success">Vendas</span>
                        <span class="badge bg-warning">Análise</span>
                    </div>
                </div>
            </div>

            <!-- Relatório de Clientes -->
            <div class="col-lg-4 col-md-6">
                <div class="report-card" onclick="window.location.href='{{ route('relatorios.clientes') }}'">
                    <div class="report-icon clientes">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="report-title">Relatório de Clientes</h3>
                    <p class="report-description">
                        Dados sobre clientes cadastrados, tipos, localização e histórico de compras.
                    </p>
                    <div class="mt-3">
                        <span class="badge bg-primary">Cadastros</span>
                        <span class="badge bg-success">Tipos</span>
                        <span class="badge bg-info">Localização</span>
                    </div>
                </div>
            </div>

            <!-- Relatório de Vendas -->
            <div class="col-lg-4 col-md-6">
                <div class="report-card" onclick="window.location.href='{{ route('relatorios.vendas') }}'">
                    <div class="report-icon vendas">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="report-title">Relatório de Vendas</h3>
                    <p class="report-description">
                        Análise de vendas por período, métodos de pagamento, faturamento e tendências.
                    </p>
                    <div class="mt-3">
                        <span class="badge bg-primary">Faturamento</span>
                        <span class="badge bg-success">Período</span>
                        <span class="badge bg-warning">Tendências</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seção de relatórios rápidos -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                            <i class="fas fa-bolt me-2"></i>Relatórios Rápidos
                        </h4>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <a href="{{ route('relatorios.veiculos', ['tipo' => 'disponiveis']) }}" 
                                   class="btn btn-outline-primary w-100">
                                    <i class="fas fa-car me-2"></i>Veículos Disponíveis
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('relatorios.vendas', ['periodo' => 'mes']) }}" 
                                   class="btn btn-outline-success w-100">
                                    <i class="fas fa-calendar me-2"></i>Vendas do Mês
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('relatorios.clientes', ['tipo' => 'novos']) }}" 
                                   class="btn btn-outline-info w-100">
                                    <i class="fas fa-user-plus me-2"></i>Novos Clientes
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('relatorios.vendas', ['tipo' => 'faturamento']) }}" 
                                   class="btn btn-outline-warning w-100">
                                    <i class="fas fa-dollar-sign me-2"></i>Faturamento
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
