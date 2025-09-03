<section>
    <div class="mb-4">
        <div class="alert alert-danger border-0" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle me-3" style="font-size: 1.5rem;"></i>
                <div>
                    <h6 class="alert-heading fw-bold mb-1">⚠️ Ação Irreversível</h6>
                    <p class="mb-0">
                        Uma vez que sua conta for excluída, todos os recursos e dados serão permanentemente removidos. 
                        <strong>Faça backup de qualquer informação importante antes de continuar.</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Warning Information -->
    <div class="mb-4 p-3 bg-light rounded">
        <h6 class="fw-semibold text-danger mb-2">
            <i class="fas fa-info-circle me-2"></i>O que será excluído:
        </h6>
        <ul class="list-unstyled text-muted small mb-0">
            <li><i class="fas fa-times text-danger me-2"></i>Seu perfil e dados pessoais</li>
            <li><i class="fas fa-times text-danger me-2"></i>Histórico de atividades</li>
            <li><i class="fas fa-times text-danger me-2"></i>Configurações e preferências</li>
            <li><i class="fas fa-times text-danger me-2"></i>Todos os dados associados à sua conta</li>
        </ul>
    </div>

    <!-- Delete Button -->
    <div class="d-grid">
        <button type="button" class="btn btn-danger btn-lg fw-semibold" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
            <i class="fas fa-trash-alt me-2"></i>Excluir Conta Permanentemente
        </button>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold" id="confirmUserDeletionModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Exclusão da Conta
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form method="post" action="{{ route('profile.destroy') }}" class="needs-validation" novalidate>
                    @csrf
                    @method('delete')
                    
                    <div class="modal-body p-4">
                        <div class="text-center mb-4">
                            <i class="fas fa-user-times text-danger" style="font-size: 3rem;"></i>
                        </div>
                        
                        <div class="alert alert-warning border-0 mb-4">
                            <h6 class="alert-heading fw-bold">
                                <i class="fas fa-warning me-2"></i>Você tem certeza?
                            </h6>
                            <p class="mb-0">
                                Esta ação <strong>não pode ser desfeita</strong>. Todos os seus dados serão permanentemente removidos do sistema.
                            </p>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold text-dark">
                                <i class="fas fa-lock text-danger me-2"></i>Digite sua senha para confirmar
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-key text-muted"></i>
                                </span>
                                <input id="password" name="password" type="password" 
                                       class="form-control border-start-0 @error('password', 'userDeletion') is-invalid @enderror" 
                                       placeholder="Digite sua senha atual" required>
                                <button class="btn btn-outline-secondary border-start-0" type="button" id="toggleDeletePassword">
                                    <i class="fas fa-eye" id="toggleDeletePasswordIcon"></i>
                                </button>
                            </div>
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="confirmDeletion" required>
                            <label class="form-check-label text-muted" for="confirmDeletion">
                                <strong>Eu entendo que esta ação é irreversível</strong> e que todos os meus dados serão permanentemente excluídos.
                            </label>
                        </div>
                    </div>
                    
                    <div class="modal-footer border-0 p-4">
                        <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger fw-semibold" id="confirmDeleteBtn" disabled>
                            <i class="fas fa-trash-alt me-2"></i>Sim, Excluir Conta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('toggleDeletePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = document.getElementById('toggleDeletePasswordIcon');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Enable delete button only when checkbox is checked
        document.getElementById('confirmDeletion').addEventListener('change', function() {
            const deleteBtn = document.getElementById('confirmDeleteBtn');
            deleteBtn.disabled = !this.checked;
        });

        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Show modal if there are errors
        @if($errors->userDeletion->isNotEmpty())
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'));
                modal.show();
            });
        @endif
    </script>
</section>
