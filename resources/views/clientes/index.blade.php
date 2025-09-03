<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 fw-bold">
                {{ __('Clientes') }}
            </h2>
        </div>
    </x-slot>

    <style>
        /* Garantir que os botões de ação sejam sempre visíveis */
        .btn-group {
            display: flex !important;
            visibility: visible !important;
        }
        
        .btn-group .btn {
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
            min-width: 32px;
            height: 32px;
            padding: 0.25rem 0.5rem;
            border: 1px solid;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            line-height: 1.5;
            text-align: center;
            text-decoration: none;
            transition: all 0.15s ease-in-out;
        }
        
        .btn-group .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .btn-outline-primary {
            color: #1e293b;
            border-color: #1e293b;
            background-color: transparent;
        }
        
        .btn-outline-primary:hover {
            color: #fff;
            background-color: #1e293b;
            border-color: #1e293b;
        }
        
        .btn-outline-warning {
            color: #d97706;
            border-color: #d97706;
            background-color: transparent;
        }
        
        .btn-outline-warning:hover {
            color: #fff;
            background-color: #d97706;
            border-color: #d97706;
        }
        
        .btn-outline-danger {
            color: #dc2626;
            border-color: #dc2626;
            background-color: transparent;
        }
        
        .btn-outline-danger:hover {
            color: #fff;
            background-color: #dc2626;
            border-color: #dc2626;
        }
        
        .btn-outline-secondary {
            color: #6b7280;
            border-color: #6b7280;
            background-color: transparent;
        }
        
        .btn-outline-secondary:hover {
            color: #fff;
            background-color: #6b7280;
            border-color: #6b7280;
        }
        
        /* Garantir que os ícones sejam visíveis */
        .btn i {
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        /* Forçar visibilidade dos botões na tabela */
        table .btn-group {
            display: flex !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        table .btn-group .btn {
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
            margin: 0 2px;
        }
        
        /* Cores sofisticadas para badges */
        .badge.bg-primary {
            background: #1e293b !important;
        }
        
        .badge.bg-success {
            background: #059669 !important;
        }
        
        /* Cards sofisticados */
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .card.bg-light {
            background: #f8fafc !important;
            border: 1px solid #e2e8f0;
        }
        
        /* Botões principais */
        .btn-primary {
            background: #1e293b;
            border-color: #1e293b;
        }
        
        .btn-primary:hover {
            background: #0f172a;
            border-color: #0f172a;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(30, 41, 59, 0.2);
        }
        
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
        
        /* Formulários sofisticados */
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
        
        /* Labels sofisticados */
        .form-label {
            color: #1e293b;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Cabeçalho com botão de adicionar -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h5 mb-0 fw-bold">Lista de Clientes</h3>
                    <a href="{{ route('clientes.create') }}" 
                       class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Adicionar Cliente
                    </a>
                </div>

                <!-- Filtros -->
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <form method="GET" action="{{ route('clientes.index') }}" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Nome</label>
                                <input type="text" name="nome" value="{{ request('nome') }}" 
                                       class="form-control" placeholder="Ex: João Silva">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ request('email') }}" 
                                       class="form-control" placeholder="Ex: joao@email.com">
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
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-search me-2"></i>Filtrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabela de clientes -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Cliente</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Contato</th>
                                <th scope="col">Documento</th>
                                <th scope="col">Endereço</th>
                                <th scope="col">Ações</th>
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
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('clientes.show', $cliente) }}" 
                                               class="btn btn-outline-primary" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('clientes.edit', $cliente) }}" 
                                               class="btn btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('clientes.destroy', $cliente) }}" 
                                                  class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Excluir">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
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

                <!-- Paginação -->
                @if($clientes->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $clientes->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Garantir que os botões de ação sejam visíveis
        document.addEventListener('DOMContentLoaded', function() {
            const btnGroups = document.querySelectorAll('.btn-group');
            btnGroups.forEach(function(group) {
                group.style.display = 'flex';
                group.style.visibility = 'visible';
                group.style.opacity = '1';
                
                const buttons = group.querySelectorAll('.btn');
                buttons.forEach(function(btn) {
                    btn.style.display = 'inline-block';
                    btn.style.visibility = 'visible';
                    btn.style.opacity = '1';
                });
            });
            
            // Debug: log para verificar se os botões estão sendo encontrados
            console.log('Botões encontrados:', document.querySelectorAll('.btn-group .btn').length);
        });
    </script>
</x-app-layout>