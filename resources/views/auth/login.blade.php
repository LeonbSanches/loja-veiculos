<x-guest-layout>
    <!-- Header Section -->
    <div class="text-center mb-4">
        <div class="mb-3">
            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                <i class="fas fa-sign-in-alt text-white" style="font-size: 1.5rem;"></i>
            </div>
        </div>
        <h2 class="fw-semibold text-dark mb-2">Bem-vindo de volta</h2>
        <p class="text-muted mb-0">Entre na sua conta para continuar</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label fw-medium text-dark mb-2">Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </span>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
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
                       name="password" required autocomplete="current-password"
                       placeholder="Digite sua senha">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                </button>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label class="form-check-label text-muted" for="remember_me">
                    Lembrar de mim
                </label>
            </div>
            @if (Route::has('password.request'))
                <a class="text-decoration-none text-primary fw-medium" href="{{ route('password.request') }}">
                    Esqueceu a senha?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-primary fw-medium">
                <i class="fas fa-sign-in-alt me-2"></i>Entrar
            </button>
        </div>
    </form>

    <!-- Divider -->
    <div class="text-center mb-4">
        <hr class="my-3">
        <span class="text-muted bg-white px-3 small">ou</span>
    </div>

    <!-- Register Link -->
    <div class="text-center">
        <p class="text-muted mb-2 small">Não tem uma conta?</p>
        <a href="{{ route('register') }}" class="btn btn-outline-primary fw-medium">
            <i class="fas fa-user-plus me-2"></i>Criar conta
        </a>
    </div>

    <!-- Demo Credentials (for development) -->
    @if(app()->environment('local'))
        <div class="mt-4 p-3 bg-light rounded">
            <small class="text-muted">
                <strong>Demo:</strong> admin@example.com / password
            </small>
        </div>
    @endif

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
