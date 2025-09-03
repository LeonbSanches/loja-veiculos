<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
        
        <style>
            /* Reset e base */
            body {
                font-family: 'Inter', sans-serif;
                background: #f8fafc;
                min-height: 100vh;
            }
            
            /* Container principal */
            .auth-container {
                background: #ffffff;
                border-radius: 16px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
                border: 1px solid #e2e8f0;
                backdrop-filter: none;
            }
            
            /* Animações suaves */
            .fade-in {
                animation: fadeIn 0.6s ease-out;
            }
            
            @keyframes fadeIn {
                from { 
                    opacity: 0; 
                    transform: translateY(20px); 
                }
                to { 
                    opacity: 1; 
                    transform: translateY(0); 
                }
            }
            
            /* Formulários */
            .form-control {
                transition: all 0.3s ease;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                padding: 0.75rem 1rem;
                font-size: 0.95rem;
            }
            
            .form-control:focus {
                border-color: #1e293b;
                box-shadow: 0 0 0 0.2rem rgba(30, 41, 59, 0.1);
                transform: none;
            }
            
            .form-control::placeholder {
                color: #9ca3af;
            }
            
            /* Input groups */
            .input-group-text {
                background: #f8fafc;
                border: 1px solid #d1d5db;
                border-right: none;
                color: #6b7280;
                transition: all 0.3s ease;
            }
            
            .input-group:focus-within .input-group-text {
                background: #f1f5f9;
                border-color: #1e293b;
                color: #1e293b;
            }
            
            .input-group .form-control {
                border-left: none;
            }
            
            .input-group:focus-within .form-control {
                border-left: none;
            }
            
            /* Botões */
            .btn {
                transition: all 0.3s ease;
                border-radius: 8px;
                font-weight: 500;
                padding: 0.75rem 1.5rem;
                border: 1px solid transparent;
            }
            
            .btn:hover {
                transform: translateY(-1px);
            }
            
            .btn-primary {
                background: #1e293b;
                border-color: #1e293b;
            }
            
            .btn-primary:hover {
                background: #0f172a;
                border-color: #0f172a;
                box-shadow: 0 4px 12px rgba(30, 41, 59, 0.2);
            }
            
            .btn-success {
                background: #059669;
                border-color: #059669;
            }
            
            .btn-success:hover {
                background: #047857;
                border-color: #047857;
                box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2);
            }
            
            .btn-warning {
                background: #d97706;
                border-color: #d97706;
            }
            
            .btn-warning:hover {
                background: #b45309;
                border-color: #b45309;
                box-shadow: 0 4px 12px rgba(217, 119, 6, 0.2);
            }
            
            .btn-info {
                background: #0891b2;
                border-color: #0891b2;
            }
            
            .btn-info:hover {
                background: #0e7490;
                border-color: #0e7490;
                box-shadow: 0 4px 12px rgba(8, 145, 178, 0.2);
            }
            
            .btn-secondary {
                background: #6b7280;
                border-color: #6b7280;
            }
            
            .btn-secondary:hover {
                background: #4b5563;
                border-color: #4b5563;
                box-shadow: 0 4px 12px rgba(107, 114, 128, 0.2);
            }
            
            /* Botões outline */
            .btn-outline-primary {
                border-color: #1e293b;
                color: #1e293b;
                background: transparent;
            }
            
            .btn-outline-primary:hover {
                background: #1e293b;
                border-color: #1e293b;
            }
            
            .btn-outline-success {
                border-color: #059669;
                color: #059669;
                background: transparent;
            }
            
            .btn-outline-success:hover {
                background: #059669;
                border-color: #059669;
            }
            
            .btn-outline-warning {
                border-color: #d97706;
                color: #d97706;
                background: transparent;
            }
            
            .btn-outline-warning:hover {
                background: #d97706;
                border-color: #d97706;
            }
            
            .btn-outline-info {
                border-color: #0891b2;
                color: #0891b2;
                background: transparent;
            }
            
            .btn-outline-info:hover {
                background: #0891b2;
                border-color: #0891b2;
            }
            
            .btn-outline-secondary {
                border-color: #6b7280;
                color: #6b7280;
                background: transparent;
            }
            
            .btn-outline-secondary:hover {
                background: #6b7280;
                border-color: #6b7280;
            }
            
            /* Checkboxes */
            .form-check-input {
                border: 1px solid #d1d5db;
                transition: all 0.3s ease;
            }
            
            .form-check-input:checked {
                background-color: #1e293b;
                border-color: #1e293b;
            }
            
            .form-check-input:focus {
                border-color: #1e293b;
                box-shadow: 0 0 0 0.2rem rgba(30, 41, 59, 0.1);
            }
            
            /* Cores de texto */
            .text-primary {
                color: #1e293b !important;
            }
            
            .text-success {
                color: #059669 !important;
            }
            
            .text-warning {
                color: #d97706 !important;
            }
            
            .text-info {
                color: #0891b2 !important;
            }
            
            .text-secondary {
                color: #6b7280 !important;
            }
            
            .text-muted {
                color: #6b7280 !important;
            }
            
            /* Links */
            a {
                color: #1e293b;
                text-decoration: none;
                transition: color 0.3s ease;
            }
            
            a:hover {
                color: #0f172a;
            }
            
            /* Alertas */
            .alert {
                border: none;
                border-radius: 8px;
                padding: 1rem;
            }
            
            .alert-success {
                background: #f0fdf4;
                color: #166534;
                border-left: 4px solid #059669;
            }
            
            .alert-warning {
                background: #fffbeb;
                color: #92400e;
                border-left: 4px solid #d97706;
            }
            
            .alert-info {
                background: #f0f9ff;
                color: #0c4a6e;
                border-left: 4px solid #0891b2;
            }
            
            .alert-danger {
                background: #fef2f2;
                color: #991b1b;
                border-left: 4px solid #dc2626;
            }
            
            /* Progress bars */
            .progress {
                height: 6px;
                border-radius: 3px;
                background: #f1f5f9;
            }
            
            .progress-bar {
                border-radius: 3px;
            }
            
            /* Badges */
            .badge {
                font-size: 0.75rem;
                padding: 0.4em 0.8em;
                font-weight: 500;
                border-radius: 6px;
            }
            
            .badge.bg-primary {
                background: #1e293b !important;
            }
            
            .badge.bg-success {
                background: #059669 !important;
            }
            
            .badge.bg-warning {
                background: #d97706 !important;
            }
            
            .badge.bg-info {
                background: #0891b2 !important;
            }
            
            .badge.bg-secondary {
                background: #6b7280 !important;
            }
            
            /* Validação */
            .invalid-feedback {
                color: #dc2626;
                font-size: 0.875rem;
                margin-top: 0.25rem;
            }
            
            .form-control.is-invalid {
                border-color: #dc2626;
            }
            
            .form-control.is-valid {
                border-color: #059669;
            }
            
            /* Accordion */
            .accordion-button {
                background: #f8fafc;
                border: 1px solid #e2e8f0;
                color: #1e293b;
                font-weight: 500;
            }
            
            .accordion-button:not(.collapsed) {
                background: #f1f5f9;
                color: #1e293b;
            }
            
            .accordion-button:focus {
                box-shadow: 0 0 0 0.2rem rgba(30, 41, 59, 0.1);
            }
            
            .accordion-body {
                background: #ffffff;
                border: 1px solid #e2e8f0;
                border-top: none;
            }
            
            /* Títulos e textos */
            h1, h2, h3, h4, h5, h6 {
                color: #1e293b;
                font-weight: 600;
            }
            
            .fw-bold {
                font-weight: 700 !important;
            }
            
            .fw-semibold {
                font-weight: 600 !important;
            }
            
            /* Espaçamentos */
            .mb-4 {
                margin-bottom: 1.5rem !important;
            }
            
            .py-3 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
        </style>
    </head>
    <body>
        <div class="min-h-screen d-flex align-items-center justify-content-center p-3">
            <div class="auth-container w-100" style="max-width: 450px;">
                <div class="p-4 fade-in">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
