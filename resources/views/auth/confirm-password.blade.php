<x-guest-layout>
    <!-- Header Section -->
    <div class="text-center mb-4">
        <div class="mb-3">
            <i class="fas fa-shield-check text-secondary" style="font-size: 3rem;"></i>
        </div>
        <h2 class="fw-bold text-dark mb-2">Confirmação de Segurança</h2>
        <p class="text-muted">Esta é uma área segura. Confirme sua senha para continuar.</p>
    </div>

    <!-- Confirm Password Form -->
    <form method="POST" action="{{ route('password.confirm') }}" class="needs-validation" novalidate>
        @csrf

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label fw-semibold text-dark">
                <i class="fas fa-lock text-secondary me-2"></i>Senha Atual
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-key text-muted"></i>
                </span>
                <input id="password" type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="current-password"
                       placeholder="Digite sua senha atual">
                <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword">
                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                </button>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-secondary btn-lg fw-semibold py-3">
                <i class="fas fa-check-circle me-2"></i>Confirmar
            </button>
        </div>
    </form>

    <!-- Security Info -->
    <div class="mt-4 p-3 bg-light rounded">
        <small class="text-muted">
            <i class="fas fa-info-circle me-1"></i>
            <strong>Por que preciso confirmar?</strong> Esta é uma medida de segurança para proteger sua conta.
        </small>
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
