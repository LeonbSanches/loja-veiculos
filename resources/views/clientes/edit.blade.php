<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 fw-bold">
                {{ __('Editar Cliente') }}
            </h2>
        </div>
    </x-slot>

    <style>
        /* Design sofisticado para formulários */
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .form-control, .form-select {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #1e293b;
            box-shadow: 0 0 0 0.2rem rgba(30, 41, 59, 0.1);
        }
        
        .form-control::placeholder {
            color: #9ca3af;
        }
        
        .form-label {
            color: #1e293b;
            font-weight: 500;
            margin-bottom: 0.5rem;
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
        
        .btn-secondary {
            background: #6b7280;
            border-color: #6b7280;
        }
        
        .btn-secondary:hover {
            background: #4b5563;
            border-color: #4b5563;
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.2);
        }
        
        /* Seções do formulário */
        .form-section {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .form-section h4 {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e2e8f0;
        }
        
        /* Campos obrigatórios */
        .text-danger {
            color: #dc2626 !important;
        }
        
        /* Validação */
        .invalid-feedback {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .form-control.is-invalid {
            border-color: #dc2626;
        }
        
        .form-control.is-valid {
            border-color: #059669;
        }
        
        /* Campos condicionais */
        .conditional-field {
            transition: all 0.3s ease;
        }
        
        .conditional-field.hidden {
            display: none !important;
        }
        
        /* Ícones */
        .fas {
            color: #1e293b;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('clientes.update', $cliente) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <!-- Informações Básicas -->
                        <div class="col-12">
                            <h4 class="fw-bold text-primary mb-3">
                                <i class="fas fa-user me-2"></i>Informações Básicas
                            </h4>
                        </div>

                        <div class="col-md-6">
                            <label for="tipo_cliente_id" class="form-label">Tipo de Cliente <span class="text-danger">*</span></label>
                            <select id="tipo_cliente_id" name="tipo_cliente_id" 
                                    class="form-select @error('tipo_cliente_id') is-invalid @enderror"
                                    onchange="toggleDocumentos()" required>
                                <option value="">Selecione o tipo</option>
                                @foreach($tiposDisponiveis as $tipo)
                                    <option value="{{ $tipo->id }}" {{ old('tipo_cliente_id', $cliente->tipo_cliente_id) == $tipo->id ? 'selected' : '' }}>
                                        {{ $tipo->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_cliente_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nome" class="form-label">Nome/Razão Social <span class="text-danger">*</span></label>
                            <input id="nome" class="form-control @error('nome') is-invalid @enderror" 
                                   type="text" name="nome" value="{{ old('nome', $cliente->nome) }}" required autofocus />
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input id="email" class="form-control @error('email') is-invalid @enderror" 
                                   type="email" name="email" value="{{ old('email', $cliente->email) }}" required />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="telefone" class="form-label">Telefone <span class="text-danger">*</span></label>
                            <input id="telefone" class="form-control @error('telefone') is-invalid @enderror" 
                                   type="text" name="telefone" value="{{ old('telefone', $cliente->telefone) }}" required />
                            @error('telefone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="celular" class="form-label">Celular</label>
                            <input id="celular" class="form-control @error('celular') is-invalid @enderror" 
                                   type="text" name="celular" value="{{ old('celular', $cliente->celular) }}" />
                            @error('celular')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Documentos -->
                        <div class="col-12">
                            <h4 class="fw-bold text-primary mb-3">
                                <i class="fas fa-id-card me-2"></i>Documentos
                            </h4>
                        </div>

                        <div class="col-md-6" id="cpf-field" style="display: none;">
                            <label for="cpf" class="form-label">CPF</label>
                            <input id="cpf" class="form-control @error('cpf') is-invalid @enderror" 
                                   type="text" name="cpf" value="{{ old('cpf', $cliente->cpf) }}" />
                            @error('cpf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6" id="rg-field" style="display: none;">
                            <label for="rg" class="form-label">RG</label>
                            <input id="rg" class="form-control @error('rg') is-invalid @enderror" 
                                   type="text" name="rg" value="{{ old('rg', $cliente->rg) }}" />
                            @error('rg')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6" id="cnpj-field" style="display: none;">
                            <label for="cnpj" class="form-label">CNPJ</label>
                            <input id="cnpj" class="form-control @error('cnpj') is-invalid @enderror" 
                                   type="text" name="cnpj" value="{{ old('cnpj', $cliente->cnpj) }}" />
                            @error('cnpj')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6" id="ie-field" style="display: none;">
                            <label for="ie" class="form-label">Inscrição Estadual</label>
                            <input id="ie" class="form-control @error('ie') is-invalid @enderror" 
                                   type="text" name="ie" value="{{ old('ie', $cliente->ie) }}" />
                            @error('ie')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6" id="data-nascimento-field" style="display: none;">
                            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                            <input id="data_nascimento" class="form-control @error('data_nascimento') is-invalid @enderror" 
                                   type="date" name="data_nascimento" value="{{ old('data_nascimento', $cliente->data_nascimento?->format('Y-m-d')) }}" />
                            @error('data_nascimento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Endereço -->
                        <div class="col-12">
                            <h4 class="fw-bold text-primary mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>Endereço
                            </h4>
                        </div>

                        <div class="col-md-8">
                            <label for="endereco" class="form-label">Endereço <span class="text-danger">*</span></label>
                            <input id="endereco" class="form-control @error('endereco') is-invalid @enderror" 
                                   type="text" name="endereco" value="{{ old('endereco', $cliente->endereco) }}" required />
                            @error('endereco')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="numero" class="form-label">Número <span class="text-danger">*</span></label>
                            <input id="numero" class="form-control @error('numero') is-invalid @enderror" 
                                   type="text" name="numero" value="{{ old('numero', $cliente->numero) }}" required />
                            @error('numero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input id="complemento" class="form-control @error('complemento') is-invalid @enderror" 
                                   type="text" name="complemento" value="{{ old('complemento', $cliente->complemento) }}" />
                            @error('complemento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="bairro" class="form-label">Bairro <span class="text-danger">*</span></label>
                            <input id="bairro" class="form-control @error('bairro') is-invalid @enderror" 
                                   type="text" name="bairro" value="{{ old('bairro', $cliente->bairro) }}" required />
                            @error('bairro')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="cep" class="form-label">CEP <span class="text-danger">*</span></label>
                            <input id="cep" class="form-control @error('cep') is-invalid @enderror" 
                                   type="text" name="cep" value="{{ old('cep', $cliente->cep) }}" required />
                            @error('cep')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="cidade" class="form-label">Cidade <span class="text-danger">*</span></label>
                            <input id="cidade" class="form-control @error('cidade') is-invalid @enderror" 
                                   type="text" name="cidade" value="{{ old('cidade', $cliente->cidade) }}" required />
                            @error('cidade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
                            <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror" required>
                                <option value="">Selecione o estado</option>
                                <option value="AC" {{ old('estado', $cliente->estado) == 'AC' ? 'selected' : '' }}>Acre</option>
                                <option value="AL" {{ old('estado', $cliente->estado) == 'AL' ? 'selected' : '' }}>Alagoas</option>
                                <option value="AP" {{ old('estado', $cliente->estado) == 'AP' ? 'selected' : '' }}>Amapá</option>
                                <option value="AM" {{ old('estado', $cliente->estado) == 'AM' ? 'selected' : '' }}>Amazonas</option>
                                <option value="BA" {{ old('estado', $cliente->estado) == 'BA' ? 'selected' : '' }}>Bahia</option>
                                <option value="CE" {{ old('estado', $cliente->estado) == 'CE' ? 'selected' : '' }}>Ceará</option>
                                <option value="DF" {{ old('estado', $cliente->estado) == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                                <option value="ES" {{ old('estado', $cliente->estado) == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                                <option value="GO" {{ old('estado', $cliente->estado) == 'GO' ? 'selected' : '' }}>Goiás</option>
                                <option value="MA" {{ old('estado', $cliente->estado) == 'MA' ? 'selected' : '' }}>Maranhão</option>
                                <option value="MT" {{ old('estado', $cliente->estado) == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                                <option value="MS" {{ old('estado', $cliente->estado) == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                                <option value="MG" {{ old('estado', $cliente->estado) == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                                <option value="PA" {{ old('estado', $cliente->estado) == 'PA' ? 'selected' : '' }}>Pará</option>
                                <option value="PB" {{ old('estado', $cliente->estado) == 'PB' ? 'selected' : '' }}>Paraíba</option>
                                <option value="PR" {{ old('estado', $cliente->estado) == 'PR' ? 'selected' : '' }}>Paraná</option>
                                <option value="PE" {{ old('estado', $cliente->estado) == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                                <option value="PI" {{ old('estado', $cliente->estado) == 'PI' ? 'selected' : '' }}>Piauí</option>
                                <option value="RJ" {{ old('estado', $cliente->estado) == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                                <option value="RN" {{ old('estado', $cliente->estado) == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                                <option value="RS" {{ old('estado', $cliente->estado) == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                                <option value="RO" {{ old('estado', $cliente->estado) == 'RO' ? 'selected' : '' }}>Rondônia</option>
                                <option value="RR" {{ old('estado', $cliente->estado) == 'RR' ? 'selected' : '' }}>Roraima</option>
                                <option value="SC" {{ old('estado', $cliente->estado) == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                                <option value="SP" {{ old('estado', $cliente->estado) == 'SP' ? 'selected' : '' }}>São Paulo</option>
                                <option value="SE" {{ old('estado', $cliente->estado) == 'SE' ? 'selected' : '' }}>Sergipe</option>
                                <option value="TO" {{ old('estado', $cliente->estado) == 'TO' ? 'selected' : '' }}>Tocantins</option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Observações -->
                        <div class="col-12">
                            <label for="observacoes" class="form-label">Observações</label>
                            <textarea id="observacoes" name="observacoes" rows="4" 
                                      class="form-control @error('observacoes') is-invalid @enderror">{{ old('observacoes', $cliente->observacoes) }}</textarea>
                            @error('observacoes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('clientes.show', $cliente) }}" 
                           class="btn btn-secondary me-2">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Atualizar Cliente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleDocumentos() {
            const tipoSelect = document.getElementById('tipo_cliente_id');
            const tipoId = tipoSelect.value;
            
            // Esconder todos os campos primeiro
            document.getElementById('cpf-field').style.display = 'none';
            document.getElementById('rg-field').style.display = 'none';
            document.getElementById('cnpj-field').style.display = 'none';
            document.getElementById('ie-field').style.display = 'none';
            document.getElementById('data-nascimento-field').style.display = 'none';
            
            // Mostrar campos baseado no tipo selecionado
            if (tipoId) {
                // Assumindo que tipo 1 é PF e tipo 2 é PJ
                if (tipoId == 1) { // Pessoa Física
                    document.getElementById('cpf-field').style.display = 'block';
                    document.getElementById('rg-field').style.display = 'block';
                    document.getElementById('data-nascimento-field').style.display = 'block';
                } else if (tipoId == 2) { // Pessoa Jurídica
                    document.getElementById('cnpj-field').style.display = 'block';
                    document.getElementById('ie-field').style.display = 'block';
                }
            }
        }
        
        // Executar na carga da página
        document.addEventListener('DOMContentLoaded', function() {
            toggleDocumentos();
        });
    </script>
</x-app-layout>