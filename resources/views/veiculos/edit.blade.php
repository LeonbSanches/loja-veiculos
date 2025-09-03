<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 fw-bold">
                {{ __('Editar Veículo') }}
            </h2>
        </div>
    </x-slot>

    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('veiculos.update', $veiculo) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <!-- Informações Básicas -->
                        <div class="col-12">
                            <h4 class="fw-bold text-primary mb-3">
                                <i class="fas fa-car me-2"></i>Informações Básicas
                            </h4>
                        </div>

                        <div class="col-md-6">
                            <label for="marca" class="form-label">Marca <span class="text-danger">*</span></label>
                            <input id="marca" class="form-control @error('marca') is-invalid @enderror" 
                                   type="text" name="marca" value="{{ old('marca', $veiculo->marca) }}" required autofocus />
                            @error('marca')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="modelo" class="form-label">Modelo <span class="text-danger">*</span></label>
                            <input id="modelo" class="form-control @error('modelo') is-invalid @enderror" 
                                   type="text" name="modelo" value="{{ old('modelo', $veiculo->modelo) }}" required />
                            @error('modelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="versao" class="form-label">Versão</label>
                            <input id="versao" class="form-control @error('versao') is-invalid @enderror" 
                                   type="text" name="versao" value="{{ old('versao', $veiculo->versao) }}" />
                            @error('versao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="cor" class="form-label">Cor</label>
                            <input id="cor" class="form-control @error('cor') is-invalid @enderror" 
                                   type="text" name="cor" value="{{ old('cor', $veiculo->cor) }}" />
                            @error('cor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Ano e Quilometragem -->
                        <div class="col-12">
                            <h4 class="fw-bold text-primary mb-3">
                                <i class="fas fa-calendar me-2"></i>Ano e Quilometragem
                            </h4>
                        </div>

                        <div class="col-md-4">
                            <label for="ano_fab" class="form-label">Ano de Fabricação <span class="text-danger">*</span></label>
                            <input id="ano_fab" class="form-control @error('ano_fab') is-invalid @enderror" 
                                   type="number" name="ano_fab" value="{{ old('ano_fab', $veiculo->ano_fab) }}" 
                                   min="1900" max="{{ date('Y') + 1 }}" required />
                            @error('ano_fab')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="ano_modelo" class="form-label">Ano do Modelo <span class="text-danger">*</span></label>
                            <input id="ano_modelo" class="form-control @error('ano_modelo') is-invalid @enderror" 
                                   type="number" name="ano_modelo" value="{{ old('ano_modelo', $veiculo->ano_modelo) }}" 
                                   min="1900" max="{{ date('Y') + 1 }}" required />
                            @error('ano_modelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="km" class="form-label">Quilometragem <span class="text-danger">*</span></label>
                            <input id="km" class="form-control @error('km') is-invalid @enderror" 
                                   type="number" name="km" value="{{ old('km', $veiculo->km) }}" min="0" required />
                            @error('km')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Documentação -->
                        <div class="col-12">
                            <h4 class="fw-bold text-primary mb-3">
                                <i class="fas fa-file-alt me-2"></i>Documentação
                            </h4>
                        </div>

                        <div class="col-md-6">
                            <label for="chassi" class="form-label">Chassi</label>
                            <input id="chassi" class="form-control @error('chassi') is-invalid @enderror" 
                                   type="text" name="chassi" value="{{ old('chassi', $veiculo->chassi) }}" />
                            @error('chassi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="placa" class="form-label">Placa</label>
                            <input id="placa" class="form-control @error('placa') is-invalid @enderror" 
                                   type="text" name="placa" value="{{ old('placa', $veiculo->placa) }}" />
                            @error('placa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Preços -->
                        <div class="col-12">
                            <h4 class="fw-bold text-primary mb-3">
                                <i class="fas fa-dollar-sign me-2"></i>Preços
                            </h4>
                        </div>

                        <div class="col-md-6">
                            <label for="preco_compra" class="form-label">Preço de Compra <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input id="preco_compra" class="form-control @error('preco_compra') is-invalid @enderror" 
                                       type="number" name="preco_compra" value="{{ old('preco_compra', $veiculo->preco_compra) }}" 
                                       step="0.01" min="0" required />
                                @error('preco_compra')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="preco_venda" class="form-label">Preço de Venda <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input id="preco_venda" class="form-control @error('preco_venda') is-invalid @enderror" 
                                       type="number" name="preco_venda" value="{{ old('preco_venda', $veiculo->preco_venda) }}" 
                                       step="0.01" min="0" required />
                                @error('preco_venda')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label for="status_id" class="form-label">Status <span class="text-danger">*</span></label>
                            <select id="status_id" name="status_id" class="form-select @error('status_id') is-invalid @enderror" required>
                                @foreach($statusDisponiveis as $status)
                                    <option value="{{ $status->id }}" {{ old('status_id', $veiculo->status_id) == $status->id ? 'selected' : '' }}>
                                        {{ $status->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fotos -->
                        <div class="col-12">
                            <h4 class="fw-bold text-primary mb-3">
                                <i class="fas fa-images me-2"></i>Adicionar Novas Fotos
                            </h4>
                            <label for="fotos" class="form-label">Selecionar Fotos</label>
                            <input id="fotos" class="form-control @error('fotos') is-invalid @enderror" 
                                   type="file" name="fotos[]" multiple accept="image/*" />
                            <div class="form-text">Selecione uma ou mais fotos para adicionar ao veículo.</div>
                            @error('fotos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Observações -->
                        <div class="col-12">
                            <label for="observacoes" class="form-label">Observações</label>
                            <textarea id="observacoes" name="observacoes" rows="4" 
                                      class="form-control @error('observacoes') is-invalid @enderror">{{ old('observacoes', $veiculo->observacoes) }}</textarea>
                            @error('observacoes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('veiculos.show', $veiculo) }}" 
                           class="btn btn-secondary me-2">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Atualizar Veículo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>