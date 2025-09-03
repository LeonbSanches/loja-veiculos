<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 fw-bold">
                {{ __('Detalhes do Veículo') }}
            </h2>
        </div>
    </x-slot>

    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Cabeçalho com ações -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h5 mb-0 fw-bold">{{ $veiculo->marca }} {{ $veiculo->modelo }}</h3>
                    <div class="btn-group" role="group">
                        <a href="{{ route('veiculos.edit', $veiculo) }}" 
                           class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Editar
                        </a>
                        <a href="{{ route('veiculos.index') }}" 
                           class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Voltar
                        </a>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Informações Principais -->
                    <div class="col-lg-8">
                        <!-- Informações do Veículo -->
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h4 class="card-title text-primary mb-4">
                                    <i class="fas fa-car me-2"></i>Informações do Veículo
                                </h4>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Marca</label>
                                        <p class="mb-0">{{ $veiculo->marca }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Modelo</label>
                                        <p class="mb-0">{{ $veiculo->modelo }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Versão</label>
                                        <p class="mb-0">{{ $veiculo->versao ?? 'Não informado' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Cor</label>
                                        <p class="mb-0">{{ $veiculo->cor ?? 'Não informado' }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Ano de Fabricação</label>
                                        <p class="mb-0">{{ $veiculo->ano_fab }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Ano do Modelo</label>
                                        <p class="mb-0">{{ $veiculo->ano_modelo }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Quilometragem</label>
                                        <p class="mb-0">{{ number_format($veiculo->km, 0, ',', '.') }} km</p>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Status</label>
                                        <div>
                                            <span class="badge fs-6 
                                                {{ $veiculo->status->codigo === 'disponivel' ? 'bg-success' : 
                                                   ($veiculo->status->codigo === 'vendido' ? 'bg-danger' : 'bg-warning') }}">
                                                {{ $veiculo->status->nome }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Documentação -->
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h4 class="card-title text-primary mb-4">
                                    <i class="fas fa-file-alt me-2"></i>Documentação
                                </h4>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Chassi</label>
                                        <p class="mb-0">{{ $veiculo->chassi ?? 'Não informado' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Placa</label>
                                        <p class="mb-0">{{ $veiculo->placa ?? 'Não informado' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Preços -->
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h4 class="card-title text-primary mb-4">
                                    <i class="fas fa-dollar-sign me-2"></i>Preços
                                </h4>
                                
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Preço de Compra</label>
                                        <p class="mb-0 h5 text-muted">R$ {{ number_format($veiculo->preco_compra, 2, ',', '.') }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Preço de Venda</label>
                                        <p class="mb-0 h4 text-primary fw-bold">R$ {{ number_format($veiculo->preco_venda, 2, ',', '.') }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Margem de Lucro</label>
                                        <p class="mb-0 h5 text-success">
                                            R$ {{ number_format($veiculo->preco_venda - $veiculo->preco_compra, 2, ',', '.') }}
                                            <br>
                                            <small class="text-muted">({{ number_format((($veiculo->preco_venda - $veiculo->preco_compra) / $veiculo->preco_compra) * 100, 1) }}%)</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Observações -->
                        @if($veiculo->observacoes)
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h4 class="card-title text-primary mb-4">
                                        <i class="fas fa-sticky-note me-2"></i>Observações
                                    </h4>
                                    <p class="mb-0">{{ $veiculo->observacoes }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar com Fotos -->
                    <div class="col-lg-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h4 class="card-title text-primary mb-4">
                                    <i class="fas fa-images me-2"></i>Fotos do Veículo
                                </h4>
                                
                                @if($veiculo->fotos->count() > 0)
                                    <div class="row g-3">
                                        @foreach($veiculo->fotos->sortBy('ordem') as $foto)
                                            <div class="col-12">
                                                <div class="position-relative">
                                                    <img src="{{ Storage::url($foto->foto) }}" 
                                                         alt="{{ $foto->descricao ?? $veiculo->marca . ' ' . $veiculo->modelo }}" 
                                                         class="img-fluid rounded shadow-sm"
                                                         style="width: 100%; height: 200px; object-fit: cover;">
                                                    
                                                    <!-- Badge de foto principal -->
                                                    @if($foto->principal)
                                                        <span class="position-absolute top-0 start-0 m-2">
                                                            <span class="badge bg-warning">
                                                                <i class="fas fa-star me-1"></i>Principal
                                                            </span>
                                                        </span>
                                                    @endif
                                                    
                                                    <!-- Ações da foto -->
                                                    <div class="position-absolute top-0 end-0 m-2">
                                                        <div class="btn-group-vertical" role="group">
                                                            @if(!$foto->principal)
                                                                <form method="POST" action="{{ route('veiculos.foto-principal', [$veiculo, $foto]) }}" 
                                                                      class="d-inline">
                                                                    @csrf
                                                                    <button type="submit" 
                                                                            class="btn btn-warning btn-sm rounded-circle mb-1"
                                                                            title="Definir como principal">
                                                                        <i class="fas fa-star"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            
                                                            <form method="POST" action="{{ route('veiculos.remover-foto', [$veiculo, $foto]) }}" 
                                                                  class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover esta foto?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        class="btn btn-danger btn-sm rounded-circle"
                                                                        title="Remover foto">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Descrição da foto -->
                                                    @if($foto->descricao)
                                                        <div class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-75 text-white p-2 rounded-bottom">
                                                            <small>{{ $foto->descricao }}</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="fas fa-image text-muted mb-3" style="font-size: 3rem;"></i>
                                        <p class="text-muted">Nenhuma foto disponível</p>
                                    </div>
                                @endif

                                <!-- Botão para adicionar mais fotos -->
                                <div class="mt-4">
                                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#adicionarFotoModal">
                                        <i class="fas fa-plus me-2"></i>Adicionar Foto
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Adicionar Foto -->
    @include('veiculos.adicionar-foto')
</x-app-layout>