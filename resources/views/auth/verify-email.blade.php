<x-guest-layout>
    <!-- Header Section -->
    <div class="text-center mb-4">
        <div class="mb-3">
            <i class="fas fa-envelope-open-text text-primary" style="font-size: 3rem;"></i>
        </div>
        <h2 class="fw-bold text-dark mb-2">Verifique seu Email</h2>
        <p class="text-muted">Obrigado por se cadastrar! Verifique seu email para continuar.</p>
    </div>

    <!-- Main Message -->
    <div class="mb-4 p-3 bg-light rounded">
        <p class="text-muted mb-0">
            <i class="fas fa-info-circle text-primary me-2"></i>
            Enviamos um link de verificação para seu email. Clique no link para ativar sua conta. 
            Se não recebeu o email, podemos enviar outro.
        </p>
    </div>

    <!-- Success Message -->
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-3 bg-success bg-opacity-10 border border-success border-opacity-25 rounded">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle text-success me-2"></i>
                <small class="text-success fw-semibold">
                    Um novo link de verificação foi enviado para seu email!
                </small>
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="d-grid gap-3 mb-4">
        <!-- Resend Verification Email -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-lg fw-semibold py-3 w-100">
                <i class="fas fa-paper-plane me-2"></i>Reenviar Email de Verificação
            </button>
        </form>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary fw-semibold w-100">
                <i class="fas fa-sign-out-alt me-2"></i>Sair da Conta
            </button>
        </form>
    </div>

    <!-- Help Section -->
    <div class="mt-4">
        <div class="accordion" id="helpAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="helpHeading">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#helpCollapse" aria-expanded="false" aria-controls="helpCollapse">
                        <i class="fas fa-question-circle me-2"></i>Precisa de ajuda?
                    </button>
                </h2>
                <div id="helpCollapse" class="accordion-collapse collapse" aria-labelledby="helpHeading" data-bs-parent="#helpAccordion">
                    <div class="accordion-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <h6 class="fw-semibold text-primary">
                                    <i class="fas fa-search me-2"></i>Não encontrou o email?
                                </h6>
                                <ul class="list-unstyled text-muted small">
                                    <li><i class="fas fa-check me-2"></i>Verifique sua caixa de spam</li>
                                    <li><i class="fas fa-check me-2"></i>Procure por emails de "{{ config('app.name') }}"</li>
                                    <li><i class="fas fa-check me-2"></i>Adicione nosso email aos contatos</li>
                                </ul>
                            </div>
                            <div class="col-12">
                                <h6 class="fw-semibold text-primary">
                                    <i class="fas fa-clock me-2"></i>Quanto tempo demora?
                                </h6>
                                <p class="text-muted small mb-0">
                                    O email geralmente chega em alguns minutos. Se não receber em 15 minutos, 
                                    clique em "Reenviar Email de Verificação".
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Support -->
    <div class="text-center mt-4">
        <small class="text-muted">
            Ainda com problemas? 
            <a href="mailto:suporte@exemplo.com" class="text-primary fw-semibold text-decoration-none">
                <i class="fas fa-envelope me-1"></i>Entre em contato
            </a>
        </small>
    </div>

    <script>
        // Auto-refresh page every 30 seconds to check for verification
        setTimeout(function() {
            location.reload();
        }, 30000);

        // Show a notification about auto-refresh
        setTimeout(function() {
            const notification = document.createElement('div');
            notification.className = 'alert alert-info alert-dismissible fade show position-fixed';
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; max-width: 300px;';
            notification.innerHTML = `
                <i class="fas fa-info-circle me-2"></i>
                <small>Verificando automaticamente...</small>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(notification);
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 5000);
        }, 25000);
    </script>
</x-guest-layout>
