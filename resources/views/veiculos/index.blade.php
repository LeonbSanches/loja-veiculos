<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 fw-bold">
                {{ __('Veículos') }}
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
        
        /* Debug: adicionar borda para verificar se os botões estão sendo renderizados */
        .btn-group .btn {
            border: 2px solid #000 !important;
            background-color: rgba(255, 255, 255, 0.9) !important;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Cabeçalho com botão de adicionar -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h5 mb-0 fw-bold">Lista de Veículos</h3>
                    <a href="{{ route('veiculos.create') }}" 
                       class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Adicionar Veículo
                    </a>
                </div>

                <!-- Filtros -->
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <form method="GET" action="{{ route('veiculos.index') }}" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Marca</label>
                                <input type="text" name="marca" value="{{ request('marca') }}" 
                                       class="form-control" placeholder="Ex: Toyota">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Modelo</label>
                                <input type="text" name="modelo" value="{{ request('modelo') }}" 
                                       class="form-control" placeholder="Ex: Corolla">
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
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-search me-2"></i>Filtrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabela de veículos -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Veículo</th>
                                <th scope="col">Ano</th>
                                <th scope="col">KM</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ações</th>
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
                                                <div class="fw-semibold">
                                                    {{ $veiculo->marca }} {{ $veiculo->modelo }}
                                                </div>
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
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" style="display: flex !important; visibility: visible !important;">
                                            <a href="{{ route('veiculos.show', $veiculo) }}" 
                                               class="btn btn-outline-primary" title="Ver" style="display: inline-block !important; visibility: visible !important;">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('veiculos.edit', $veiculo) }}" 
                                               class="btn btn-outline-warning" title="Editar" style="display: inline-block !important; visibility: visible !important;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('veiculos.destroy', $veiculo) }}" 
                                                  class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este veículo?')" style="display: inline-block !important; visibility: visible !important;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Excluir" style="display: inline-block !important; visibility: visible !important;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
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

                <!-- Paginação -->
                @if($veiculos->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $veiculos->links() }}
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
