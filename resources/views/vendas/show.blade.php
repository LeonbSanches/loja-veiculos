<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 fw-bold">
                {{ __('Detalhes da Venda') }}
            </h2>
        </div>
    </x-slot>

    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Cabeçalho com ações -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h5 mb-0 fw-bold">Venda #{{ $venda->id }}</h3>
                    <div class="btn-group" role="group">
                        <a href="{{ route('vendas.edit', $venda) }}" 
                           class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Editar
                        </a>
                        <a href="{{ route('vendas.index') }}" 
                           class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Voltar
                        </a>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Informações da Venda -->
                    <div class="col-lg-8">
                        <!-- Dados da Venda -->
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h4 class="card-title text-primary mb-4">
                                    <i class="fas fa-handshake me-2"></i>Dados da Venda
                                </h4>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Data da Venda</label>
                                        <p class="mb-0">{{ $venda->data_venda->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Status</label>
                                        <div>
                                            <span class="badge fs-6 
                                                {{ $venda->status === 'concluida' ? 'bg-success' : 
                                                   ($venda->status === 'pendente' ? 'bg-warning' : 'bg-danger') }}">
                                                {{ ucfirst($venda->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Valor da Venda</label>
                                        <p class="mb-0 h4 text-success fw-bold">R$ {{ number_format($venda->valor_venda, 2, ',', '.') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Método de Pagamento</label>
                                        <p class="mb-0">{{ $venda->metodoPagamento->nome }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informações do Cliente -->
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h4 class="card-title text-primary mb-4">
                                    <i class="fas fa-user me-2"></i>Cliente
                                </h4>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Nome</label>
                                        <p class="mb-0">{{ $venda->cliente->nome }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Email</label>
                                        <p class="mb-0">{{ $venda->cliente->email }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Telefone</label>
                                        <p class="mb-0">{{ $venda->cliente->telefone }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Tipo</label>
                                        <p class="mb-0">
                                            <span class="badge 
                                                {{ $venda->cliente->tipoCliente->codigo === 'PF' ? 'bg-primary' : 'bg-success' }}">
                                                {{ $venda->cliente->tipoCliente->nome }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informações do Veículo -->
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h4 class="card-title text-primary mb-4">
                                    <i class="fas fa-car me-2"></i>Veículo
                                </h4>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Marca/Modelo</label>
                                        <p class="mb-0">{{ $venda->veiculo->marca }} {{ $venda->veiculo->modelo }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Ano</label>
                                        <p class="mb-0">{{ $venda->veiculo->ano_fab }}/{{ $venda->veiculo->ano_modelo }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Quilometragem</label>
                                        <p class="mb-0">{{ number_format($venda->veiculo->km, 0, ',', '.') }} km</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Cor</label>
                                        <p class="mb-0">{{ $venda->veiculo->cor }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Preço de Venda</label>
                                        <p class="mb-0 h5 text-primary fw-bold">R$ {{ number_format($venda->veiculo->preco_venda, 2, ',', '.') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Status do Veículo</label>
                                        <p class="mb-0">
                                            <span class="badge 
                                                {{ $venda->veiculo->status->codigo === 'disponivel' ? 'bg-success' : 
                                                   ($venda->veiculo->status->codigo === 'vendido' ? 'bg-danger' : 'bg-warning') }}">
                                                {{ $venda->veiculo->status->nome }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Observações -->
                        @if($venda->observacoes)
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h4 class="card-title text-primary mb-4">
                                        <i class="fas fa-sticky-note me-2"></i>Observações
                                    </h4>
                                    <p class="mb-0">{{ $venda->observacoes }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar com Informações Adicionais -->
                    <div class="col-lg-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h4 class="card-title text-primary mb-4">
                                    <i class="fas fa-info-circle me-2"></i>Informações Adicionais
                                </h4>
                                
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center p-3 bg-white rounded">
                                            <div>
                                                <h6 class="mb-1">Vendedor</h6>
                                                <h5 class="mb-0">{{ $venda->vendedor->name }}</h5>
                                            </div>
                                            <i class="fas fa-user-tie text-primary fs-3"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center p-3 bg-white rounded">
                                            <div>
                                                <h6 class="mb-1">Data de Criação</h6>
                                                <h5 class="mb-0">{{ $venda->created_at->format('d/m/Y H:i') }}</h5>
                                            </div>
                                            <i class="fas fa-calendar text-info fs-3"></i>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center p-3 bg-white rounded">
                                            <div>
                                                <h6 class="mb-1">Última Atualização</h6>
                                                <h5 class="mb-0">{{ $venda->updated_at->format('d/m/Y H:i') }}</h5>
                                            </div>
                                            <i class="fas fa-clock text-warning fs-3"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Ações Rápidas -->
                                <div class="mt-4">
                                    <h6 class="fw-bold mb-3">Ações Rápidas</h6>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('clientes.show', $venda->cliente) }}" 
                                           class="btn btn-outline-primary">
                                            <i class="fas fa-user me-2"></i>Ver Cliente
                                        </a>
                                        <a href="{{ route('veiculos.show', $venda->veiculo) }}" 
                                           class="btn btn-outline-info">
                                            <i class="fas fa-car me-2"></i>Ver Veículo
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>