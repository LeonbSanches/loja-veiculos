<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 fw-bold">
                {{ __('Editar Venda') }}
            </h2>
        </div>
    </x-slot>

    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('vendas.update', $venda) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <!-- Informações da Venda -->
                        <div class="col-12">
                            <h4 class="fw-bold text-primary mb-3">
                                <i class="fas fa-handshake me-2"></i>Informações da Venda
                            </h4>
                        </div>

                        <div class="col-md-6">
                            <label for="cliente_id" class="form-label">Cliente <span class="text-danger">*</span></label>
                            <select id="cliente_id" name="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror" required>
                                <option value="">Selecione o cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ old('cliente_id', $venda->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->nome }} - {{ $cliente->email }}
                                    </option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="veiculo_id" class="form-label">Veículo <span class="text-danger">*</span></label>
                            <select id="veiculo_id" name="veiculo_id" class="form-select @error('veiculo_id') is-invalid @enderror" required>
                                <option value="">Selecione o veículo</option>
                                @foreach($veiculos as $veiculo)
                                    <option value="{{ $veiculo->id }}" {{ old('veiculo_id', $venda->veiculo_id) == $veiculo->id ? 'selected' : '' }}>
                                        {{ $veiculo->marca }} {{ $veiculo->modelo }} - {{ $veiculo->ano_fab }}/{{ $veiculo->ano_modelo }} - R$ {{ number_format($veiculo->preco_venda, 2, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('veiculo_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="metodo_pagamento_id" class="form-label">Método de Pagamento <span class="text-danger">*</span></label>
                            <select id="metodo_pagamento_id" name="metodo_pagamento_id" class="form-select @error('metodo_pagamento_id') is-invalid @enderror" required>
                                <option value="">Selecione o método</option>
                                @foreach($metodosPagamento as $metodo)
                                    <option value="{{ $metodo->id }}" {{ old('metodo_pagamento_id', $venda->metodo_pagamento_id) == $metodo->id ? 'selected' : '' }}>
                                        {{ $metodo->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('metodo_pagamento_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="data_venda" class="form-label">Data da Venda <span class="text-danger">*</span></label>
                            <input id="data_venda" class="form-control @error('data_venda') is-invalid @enderror" 
                                   type="date" name="data_venda" value="{{ old('data_venda', $venda->data_venda->format('Y-m-d')) }}" required />
                            @error('data_venda')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="valor_venda" class="form-label">Valor da Venda <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input id="valor_venda" class="form-control @error('valor_venda') is-invalid @enderror" 
                                       type="number" name="valor_venda" value="{{ old('valor_venda', $venda->valor_venda) }}" 
                                       step="0.01" min="0" required />
                                @error('valor_venda')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="pendente" {{ old('status', $venda->status) == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                <option value="concluida" {{ old('status', $venda->status) == 'concluida' ? 'selected' : '' }}>Concluída</option>
                                <option value="cancelada" {{ old('status', $venda->status) == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Observações -->
                        <div class="col-12">
                            <label for="observacoes" class="form-label">Observações</label>
                            <textarea id="observacoes" name="observacoes" rows="4" 
                                      class="form-control @error('observacoes') is-invalid @enderror">{{ old('observacoes', $venda->observacoes) }}</textarea>
                            @error('observacoes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('vendas.show', $venda) }}" 
                           class="btn btn-secondary me-2">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Atualizar Venda
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto-preencher valor da venda quando selecionar um veículo
        document.getElementById('veiculo_id').addEventListener('change', function() {
            const veiculoId = this.value;
            const valorInput = document.getElementById('valor_venda');
            
            if (veiculoId) {
                // Aqui você pode fazer uma requisição AJAX para buscar o preço do veículo
                // Por enquanto, vamos usar um valor padrão
                fetch(`/api/veiculos/${veiculoId}/preco`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.preco) {
                            valorInput.value = data.preco;
                        }
                    })
                    .catch(error => {
                        console.log('Erro ao buscar preço do veículo:', error);
                    });
            }
        });
    </script>
</x-app-layout>