<x-guest-layout>
    <!-- Header Section -->
    <div class="text-center mb-4">
        <div class="mb-3">
            <div class="bg-warning rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                <i class="fas fa-key text-white" style="font-size: 1.5rem;"></i>
            </div>
        </div>
        <h2 class="fw-semibold text-dark mb-2">Esqueceu sua senha?</h2>
        <p class="text-muted mb-0">Digite seu email e enviaremos um link para redefinir sua senha.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Forgot Password Form -->
    <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate>
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
                       placeholder="Digite seu email cadastrado">
            </div>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-warning fw-medium">
                <i class="fas fa-paper-plane me-2"></i>Enviar Link de Recuperação
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
        <a href="{{ route('login') }}" class="btn btn-outline-warning fw-semibold mt-2">
            <i class="fas fa-arrow-left me-2"></i>Voltar ao Login
        </a>
    </div>

    <!-- Help Text -->
    <div class="mt-4 p-3 bg-light rounded">
        <small class="text-muted">
            <i class="fas fa-info-circle me-1"></i>
            <strong>Dica:</strong> Verifique sua caixa de spam caso não receba o email em alguns minutos.
        </small>
    </div>

    <script>
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
