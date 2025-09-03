<x-guest-layout>
    <!-- Header Section -->
    <div class="text-center mb-4">
        <div class="mb-3">
            <i class="fas fa-shield-alt text-info" style="font-size: 3rem;"></i>
        </div>
        <h2 class="fw-bold text-dark mb-2">Redefinir Senha</h2>
        <p class="text-muted">Crie uma nova senha segura para sua conta</p>
    </div>

    <!-- Reset Password Form -->
    <form method="POST" action="{{ route('password.store') }}" class="needs-validation" novalidate>
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label fw-semibold text-dark">
                <i class="fas fa-envelope text-info me-2"></i>Email
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-at text-muted"></i>
                </span>
                <input id="email" type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                       placeholder="Digite seu email">
            </div>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label fw-semibold text-dark">
                <i class="fas fa-lock text-info me-2"></i>Nova Senha
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-key text-muted"></i>
                </span>
                <input id="password" type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="new-password"
                       placeholder="Digite sua nova senha">
                <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword">
                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                </button>
            </div>
            <div class="form-text">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Mínimo 8 caracteres, incluindo letras e números
                </small>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-semibold text-dark">
                <i class="fas fa-lock text-info me-2"></i>Confirmar Nova Senha
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-check-circle text-muted"></i>
                </span>
                <input id="password_confirmation" type="password" class="form-control border-start-0 @error('password_confirmation') is-invalid @enderror" 
                       name="password_confirmation" required autocomplete="new-password"
                       placeholder="Confirme sua nova senha">
                <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePasswordConfirm">
                    <i class="fas fa-eye" id="togglePasswordConfirmIcon"></i>
                </button>
            </div>
            @error('password_confirmation')
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
        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-info btn-lg fw-semibold py-3">
                <i class="fas fa-save me-2"></i>Redefinir Senha
            </button>
        </div>
    </form>

    <!-- Divider -->
    <div class="text-center mb-4">
        <hr class="my-4">
        <span class="text-muted bg-white px-3">ou</span>
    </div>

    <!-- Back to Login -->
    <div class="text-center">
        <p class="text-muted mb-0">Lembrou da senha?</p>
        <a href="{{ route('login') }}" class="btn btn-outline-info fw-semibold mt-2">
            <i class="fas fa-arrow-left me-2"></i>Voltar ao Login
        </a>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = document.getElementById('togglePasswordIcon');
            
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

        // Toggle confirm password visibility
        document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
            const password = document.getElementById('password_confirmation');
            const icon = document.getElementById('togglePasswordConfirmIcon');
            
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

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
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
    </script>
</x-guest-layout>
