<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center">
            <i class="fas fa-user-cog text-primary me-3" style="font-size: 1.5rem;"></i>
            <h2 class="fw-bold text-dark mb-0">
                {{ __('Configurações do Perfil') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <!-- Profile Information Card -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-primary text-white">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-edit me-2"></i>
                                <h5 class="mb-0 fw-semibold">Informações do Perfil</h5>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password Card -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-warning text-dark">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-lock me-2"></i>
                                <h5 class="mb-0 fw-semibold">Alterar Senha</h5>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Delete Account Card -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-danger text-white">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <h5 class="mb-0 fw-semibold">Zona de Perigo</h5>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 15px;
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
        }
        
        .card-header {
            border-radius: 15px 15px 0 0 !important;
            border: none;
        }
        
        .card-body {
            border-radius: 0 0 15px 15px;
        }
        
        .bg-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }
        
        .bg-warning {
            background: linear-gradient(135deg, #ffc107 0%, #ff8f00 100%) !important;
        }
        
        .bg-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
        }
    </style>
</x-app-layout>
