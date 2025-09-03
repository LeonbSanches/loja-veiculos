<section>
    <div class="mb-4">
        <p class="text-muted mb-0">
            <i class="fas fa-shield-alt text-warning me-2"></i>
            Certifique-se de que sua conta está usando uma senha longa e aleatória para manter a segurança.
        </p>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="needs-validation" novalidate>
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="mb-4">
            <label for="update_password_current_password" class="form-label fw-semibold text-dark">
                <i class="fas fa-lock text-warning me-2"></i>Senha Atual
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-key text-muted"></i>
                </span>
                <input id="update_password_current_password" name="current_password" type="password" 
                       class="form-control border-start-0 @error('current_password', 'updatePassword') is-invalid @enderror" 
                       autocomplete="current-password" placeholder="Digite sua senha atual">
                <button class="btn btn-outline-secondary border-start-0" type="button" id="toggleCurrentPassword">
                    <i class="fas fa-eye" id="toggleCurrentPasswordIcon"></i>
                </button>
            </div>
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- New Password -->
        <div class="mb-4">
            <label for="update_password_password" class="form-label fw-semibold text-dark">
                <i class="fas fa-lock text-warning me-2"></i>Nova Senha
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-key text-muted"></i>
                </span>
                <input id="update_password_password" name="password" type="password" 
                       class="form-control border-start-0 @error('password', 'updatePassword') is-invalid @enderror" 
                       autocomplete="new-password" placeholder="Digite sua nova senha">
                <button class="btn btn-outline-secondary border-start-0" type="button" id="toggleNewPassword">
                    <i class="fas fa-eye" id="toggleNewPasswordIcon"></i>
                </button>
            </div>
            <div class="form-text">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Mínimo 8 caracteres, incluindo letras e números
                </small>
            </div>
            @error('password', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm New Password -->
        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label fw-semibold text-dark">
                <i class="fas fa-lock text-warning me-2"></i>Confirmar Nova Senha
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-check-circle text-muted"></i>
                </span>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                       class="form-control border-start-0 @error('password_confirmation', 'updatePassword') is-invalid @enderror" 
                       autocomplete="new-password" placeholder="Confirme sua nova senha">
                <button class="btn btn-outline-secondary border-start-0" type="button" id="toggleConfirmPassword">
                    <i class="fas fa-eye" id="toggleConfirmPasswordIcon"></i>
                </button>
            </div>
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password Strength Indicator -->
        <div class="mb-4">
            <div class="progress" style="height: 5px;">
                <div class="progress-bar" id="passwordStrength" role="progressbar" style="width: 0%"></div>
            </div>
            <small class="text-muted" id="passwordStrengthText">Digite uma senha para ver a força</small>
        </div>

        <!-- Submit Button -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-warning fw-semibold">
                <i class="fas fa-save me-2"></i>Salvar Nova Senha
            </button>

            @if (session('status') === 'password-updated')
                <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Sucesso!</strong> Senha atualizada com sucesso.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    </form>

    <script>
        // Toggle password visibility functions
        function togglePasswordVisibility(inputId, iconId) {
            const password = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Add event listeners for password toggles
        document.getElementById('toggleCurrentPassword').addEventListener('click', function() {
            togglePasswordVisibility('update_password_current_password', 'toggleCurrentPasswordIcon');
        });

        document.getElementById('toggleNewPassword').addEventListener('click', function() {
            togglePasswordVisibility('update_password_password', 'toggleNewPasswordIcon');
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            togglePasswordVisibility('update_password_password_confirmation', 'toggleConfirmPasswordIcon');
        });

        // Password strength indicator
        document.getElementById('update_password_password').addEventListener('input', function() {
            const password = this.value;
            const strength = getPasswordStrength(password);
            updatePasswordStrengthIndicator(strength);
        });

        function getPasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            return strength;
        }

        function updatePasswordStrengthIndicator(strength) {
            const strengthBar = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('passwordStrengthText');
            
            const strengthLevels = [
                { width: 0, color: '', text: 'Digite uma senha para ver a força' },
                { width: 20, color: 'bg-danger', text: 'Muito fraca' },
                { width: 40, color: 'bg-warning', text: 'Fraca' },
                { width: 60, color: 'bg-info', text: 'Média' },
                { width: 80, color: 'bg-primary', text: 'Forte' },
                { width: 100, color: 'bg-success', text: 'Muito forte' }
            ];
            
            const level = strengthLevels[strength];
            strengthBar.style.width = level.width + '%';
            strengthBar.className = 'progress-bar ' + level.color;
            strengthText.textContent = level.text;
        }

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

        // Auto-dismiss success alert
        setTimeout(function() {
            const alert = document.querySelector('.alert-success');
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    </script>
</section>
