<x-guest-layout>
    <!-- Header Section -->
    <div class="text-center mb-4">
        <div class="mb-3">
            <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                <i class="fas fa-user-plus text-white" style="font-size: 1.5rem;"></i>
            </div>
        </div>
        <h2 class="fw-semibold text-dark mb-2">Crie sua conta</h2>
        <p class="text-muted mb-0">Junte-se à nossa plataforma</p>
    </div>

    <!-- Registration Form -->
    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="form-label fw-medium text-dark mb-2">Nome Completo</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                       name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                       placeholder="Digite seu nome completo">
            </div>
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label fw-medium text-dark mb-2">Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </span>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autocomplete="username"
                       placeholder="Digite seu email">
            </div>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label fw-medium text-dark mb-2">Senha</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                </span>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="new-password"
                       placeholder="Digite sua senha">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                </button>
            </div>
            <div class="form-text">
                <small class="text-muted">
                    Mínimo 8 caracteres, incluindo letras e números
                </small>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-medium text-dark mb-2">Confirmar Senha</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                </span>
                <input id="password_confirmation" type="password" class="form-control" 
                       name="password_confirmation" required autocomplete="new-password"
                       placeholder="Confirme sua senha">
                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                    <i class="fas fa-eye" id="togglePasswordConfirmIcon"></i>
                </button>
            </div>
        </div>

        <!-- Terms and Conditions -->
        <div class="mb-4">
            <div class="form-check">
                <input id="terms" type="checkbox" class="form-check-input" required>
                <label class="form-check-label text-muted" for="terms">
                    Eu aceito os <a href="#" class="text-primary fw-medium">Termos de Uso</a> e 
                    <a href="#" class="text-primary fw-medium">Política de Privacidade</a>
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-success fw-medium">
                <i class="fas fa-user-plus me-2"></i>Criar Conta
            </button>
        </div>
    </form>

    <!-- Divider -->
    <div class="text-center mb-4">
        <hr class="my-3">
        <span class="text-muted bg-white px-3 small">ou</span>
    </div>

    <!-- Login Link -->
    <div class="text-center">
        <p class="text-muted mb-2 small">Já tem uma conta?</p>
        <a href="{{ route('login') }}" class="btn btn-outline-primary fw-medium">
            <i class="fas fa-sign-in-alt me-2"></i>Fazer Login
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
            // This could be enhanced with a visual strength indicator
            console.log('Password strength:', strength);
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
