<section>
    <div class="mb-4">
        <p class="text-muted mb-0">
            <i class="fas fa-info-circle text-primary me-2"></i>
            Atualize as informações do seu perfil e endereço de email.
        </p>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="needs-validation" novalidate>
        @csrf
        @method('patch')

        <!-- Name Field -->
        <div class="mb-4">
            <label for="name" class="form-label fw-semibold text-dark">
                <i class="fas fa-user text-primary me-2"></i>Nome Completo
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-id-card text-muted"></i>
                </span>
                <input id="name" name="name" type="text" class="form-control border-start-0 @error('name') is-invalid @enderror" 
                       value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                       placeholder="Digite seu nome completo">
            </div>
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Field -->
        <div class="mb-4">
            <label for="email" class="form-label fw-semibold text-dark">
                <i class="fas fa-envelope text-primary me-2"></i>Email
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-at text-muted"></i>
                </span>
                <input id="email" name="email" type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" 
                       value="{{ old('email', $user->email) }}" required autocomplete="username"
                       placeholder="Digite seu email">
            </div>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror

            <!-- Email Verification Status -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-warning bg-opacity-10 border border-warning border-opacity-25 rounded">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                        <div class="flex-grow-1">
                            <p class="text-warning mb-1 fw-semibold">
                                Seu email não foi verificado.
                            </p>
                            <button form="send-verification" class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-paper-plane me-1"></i>Reenviar email de verificação
                            </button>
                        </div>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <div class="mt-2 p-2 bg-success bg-opacity-10 border border-success border-opacity-25 rounded">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <small class="text-success fw-semibold">
                                    Um novo link de verificação foi enviado para seu email!
                                </small>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="mt-2 p-2 bg-success bg-opacity-10 border border-success border-opacity-25 rounded">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <small class="text-success fw-semibold">
                            Email verificado com sucesso!
                        </small>
                    </div>
                </div>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary fw-semibold">
                <i class="fas fa-save me-2"></i>Salvar Alterações
            </button>

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Sucesso!</strong> Perfil atualizado com sucesso.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    </form>

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
