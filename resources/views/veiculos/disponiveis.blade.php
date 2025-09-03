<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Veículos - Veículos Disponíveis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body class="bg-light">
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <i class="fas fa-car text-primary me-2 fs-4"></i>
                <span class="fw-bold">Loja de Veículos</span>
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
                <a class="btn btn-primary ms-2" href="{{ route('register') }}">Cadastrar</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-white py-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Encontre o Veículo dos Seus Sonhos</h1>
            <p class="lead mb-5">Explore nossa seleção de veículos de qualidade com os melhores preços</p>
            
            <!-- Filtros Rápidos -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow">
                        <div class="card-body p-4">
                            <form method="GET" action="{{ route('home') }}" class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Marca</label>
                                    <input type="text" name="marca" value="{{ request('marca') }}" 
                                           placeholder="Ex: Toyota, Honda..."
                                           class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Modelo</label>
                                    <input type="text" name="modelo" value="{{ request('modelo') }}" 
                                           placeholder="Ex: Corolla, Civic..."
                                           class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Ano Mínimo</label>
                                    <input type="number" name="ano_min" value="{{ request('ano_min') }}" 
                                           placeholder="2020"
                                           class="form-control">
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-search me-2"></i>Buscar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Veículos Disponíveis -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-dark mb-3">Veículos Disponíveis</h2>
                <p class="lead text-muted">Encontramos {{ $veiculos->total() }} veículo(s) disponível(is)</p>
            </div>

            @if($veiculos->count() > 0)
                <div class="row g-4">
                    @foreach($veiculos as $veiculo)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card h-100 card-hover shadow-sm">
                                <!-- Imagem do Veículo -->
                                <div class="position-relative" style="height: 200px; overflow: hidden;">
                                    @if($veiculo->fotos->count() > 0)
                                        @php
                                            $fotoPrincipal = $veiculo->fotos->where('principal', true)->first() ?? $veiculo->fotos->first();
                                        @endphp
                                        <img class="card-img-top h-100 object-fit-cover" 
                                             src="{{ Storage::url($fotoPrincipal->foto) }}" 
                                             alt="{{ $veiculo->marca }} {{ $veiculo->modelo }}">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                            <i class="fas fa-car text-muted" style="font-size: 4rem;"></i>
                                        </div>
                                    @endif
                                    <span class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-success">Disponível</span>
                                    </span>
                                </div>

                                <!-- Informações do Veículo -->
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold mb-2">
                                        {{ $veiculo->marca }} {{ $veiculo->modelo }}
                                    </h5>
                                    <p class="card-text text-muted small mb-3">{{ $veiculo->versao }}</p>
                                    
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                {{ $veiculo->ano_fab }}/{{ $veiculo->ano_modelo }}
                                            </small>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">
                                                <i class="fas fa-tachometer-alt me-1"></i>
                                                {{ number_format($veiculo->km, 0, ',', '.') }} km
                                            </small>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">
                                                <i class="fas fa-palette me-1"></i>
                                                {{ $veiculo->cor }}
                                            </small>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">
                                                <i class="fas fa-cog me-1"></i>
                                                {{ $veiculo->combustivel }}
                                            </small>
                                        </div>
                                    </div>

                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="h4 text-primary fw-bold mb-0">
                                                R$ {{ number_format($veiculo->preco_venda, 2, ',', '.') }}
                                            </div>
                                            <a href="{{ route('veiculos.show', $veiculo) }}" 
                                               class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye me-1"></i>Ver Detalhes
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginação -->
                @if($veiculos->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $veiculos->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="fas fa-search text-muted mb-4" style="font-size: 4rem;"></i>
                    <h4 class="fw-bold text-dark mb-3">Nenhum veículo encontrado</h4>
                    <p class="text-muted mb-4">Tente ajustar os filtros de busca para encontrar mais veículos.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-refresh me-2"></i>Limpar Filtros
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">Loja de Veículos</h5>
                    <p class="text-light">Sua loja de confiança para encontrar o veículo perfeito.</p>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">Contato</h5>
                    <p class="text-light mb-1">
                        <i class="fas fa-phone me-2"></i>Telefone: (11) 99999-9999
                    </p>
                    <p class="text-light">
                        <i class="fas fa-envelope me-2"></i>Email: contato@lojaveiculos.com
                    </p>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">Horário de Funcionamento</h5>
                    <p class="text-light mb-1">
                        <i class="fas fa-clock me-2"></i>Segunda a Sexta: 8h às 18h
                    </p>
                    <p class="text-light">
                        <i class="fas fa-clock me-2"></i>Sábado: 8h às 12h
                    </p>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center text-light">
                <p class="mb-0">&copy; 2024 Loja de Veículos. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
