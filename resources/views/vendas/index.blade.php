<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 fw-bold">
                {{ __('Vendas') }}
            </h2>
        </div>
    </x-slot>

    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Cabeçalho com botão de adicionar -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h5 mb-0 fw-bold">Lista de Vendas</h3>
                    <a href="{{ route('vendas.create') }}" 
                       class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Nova Venda
                    </a>
                </div>

                <!-- Filtros -->
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <form method="GET" action="{{ route('vendas.index') }}" class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label">Cliente</label>
                                <input type="text" name="cliente" value="{{ request('cliente') }}" 
                                       class="form-control" placeholder="Ex: João Silva">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Veículo</label>
                                <input type="text" name="veiculo" value="{{ request('veiculo') }}" 
                                       class="form-control" placeholder="Ex: Toyota Corolla">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">Todos</option>
                                    <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                    <option value="concluida" {{ request('status') == 'concluida' ? 'selected' : '' }}>Concluída</option>
                                    <option value="cancelada" {{ request('status') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Data Início</label>
                                <input type="date" name="data_inicio" value="{{ request('data_inicio') }}" 
                                       class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Data Fim</label>
                                <input type="date" name="data_fim" value="{{ request('data_fim') }}" 
                                       class="form-control">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-search me-2"></i>Filtrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabela de vendas -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Venda</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Veículo</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Data</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vendas as $venda)
                                <tr>
                                    <td>
                                        <div class="fw-semibold">#{{ $venda->id }}</div>
                                        <small class="text-muted">{{ $venda->metodoPagamento->nome }}</small>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $venda->cliente->nome }}</div>
                                        <small class="text-muted">{{ $venda->cliente->email }}</small>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $venda->veiculo->marca }} {{ $venda->veiculo->modelo }}</div>
                                        <small class="text-muted">{{ $venda->veiculo->ano_fab }}/{{ $venda->veiculo->ano_modelo }}</small>
                                    </td>
                                    <td class="fw-bold text-success">
                                        R$ {{ number_format($venda->valor_venda, 2, ',', '.') }}
                                    </td>
                                    <td>{{ $venda->data_venda->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge 
                                            {{ $venda->status === 'concluida' ? 'bg-success' : 
                                               ($venda->status === 'pendente' ? 'bg-warning' : 'bg-danger') }}">
                                            {{ ucfirst($venda->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('vendas.show', $venda) }}" 
                                               class="btn btn-outline-primary" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('vendas.edit', $venda) }}" 
                                               class="btn btn-outline-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('vendas.destroy', $venda) }}" 
                                                  class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir esta venda?')">
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
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-handshake fa-2x mb-3 d-block"></i>
                                        Nenhuma venda encontrada.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginação -->
                @if($vendas->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $vendas->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>