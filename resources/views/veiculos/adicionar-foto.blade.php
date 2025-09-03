<!-- Modal para Adicionar Foto -->
<div class="modal fade" id="adicionarFotoModal" tabindex="-1" aria-labelledby="adicionarFotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adicionarFotoModalLabel">
                    <i class="fas fa-camera me-2"></i>Adicionar Foto ao Veículo
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form method="POST" action="{{ route('veiculos.adicionar-foto', $veiculo) }}" enctype="multipart/form-data" id="adicionarFotoForm">
                @csrf
                
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Upload da Foto -->
                        <div class="col-12">
                            <label for="foto" class="form-label">Foto <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                                   id="foto" name="foto" accept="image/*" required>
                            <div class="form-text">Formatos aceitos: JPEG, PNG, JPG, GIF. Tamanho máximo: 2MB</div>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Preview da Foto -->
                        <div class="col-12" id="fotoPreview" style="display: none;">
                            <label class="form-label">Preview</label>
                            <div class="text-center">
                                <img id="previewImage" src="" alt="Preview" class="img-fluid rounded shadow-sm" style="max-height: 300px;">
                            </div>
                        </div>

                        <!-- Descrição -->
                        <div class="col-12">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea class="form-control @error('descricao') is-invalid @enderror" 
                                      id="descricao" name="descricao" rows="3" 
                                      placeholder="Ex: Foto frontal, lateral, motor, etc.">{{ old('descricao') }}</textarea>
                            @error('descricao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Foto Principal -->
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="principal" name="principal" value="1">
                                <label class="form-check-label" for="principal">
                                    <i class="fas fa-star text-warning me-1"></i>Definir como foto principal
                                </label>
                                <div class="form-text">A foto principal será exibida como destaque do veículo</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload me-2"></i>Adicionar Foto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fotoInput = document.getElementById('foto');
    const previewContainer = document.getElementById('fotoPreview');
    const previewImage = document.getElementById('previewImage');
    
    fotoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Verificar se é uma imagem
            if (!file.type.startsWith('image/')) {
                alert('Por favor, selecione apenas arquivos de imagem.');
                fotoInput.value = '';
                return;
            }
            
            // Verificar tamanho (2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('O arquivo deve ter no máximo 2MB.');
                fotoInput.value = '';
                return;
            }
            
            // Mostrar preview
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    });
    
    // Limpar preview ao fechar modal
    const modal = document.getElementById('adicionarFotoModal');
    modal.addEventListener('hidden.bs.modal', function() {
        fotoInput.value = '';
        previewContainer.style.display = 'none';
        document.getElementById('descricao').value = '';
        document.getElementById('principal').checked = false;
    });
});
</script>

