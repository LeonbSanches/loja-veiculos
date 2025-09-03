<?php

namespace App\Http\Controllers;

use App\Services\VeiculoService;
use App\Services\ClienteService;
use App\Services\VendaService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private VeiculoService $veiculoService,
        private ClienteService $clienteService,
        private VendaService $vendaService
    ) {}

    /**
     * Exibir dashboard principal
     */
    public function index(): View
    {
        // Buscar estatísticas de cada service
        $estatisticasVeiculos = $this->veiculoService->buscarEstatisticas();
        $estatisticasClientes = $this->clienteService->buscarEstatisticas();
        $estatisticasVendas = $this->vendaService->buscarEstatisticas();

        // Preparar dados para a view
        $veiculosDisponiveis = $estatisticasVeiculos['disponivel'] ?? 0;
        $totalClientes = $estatisticasClientes['total'] ?? 0;
        $vendasMes = $estatisticasVendas['vendas_mes_atual'] ?? 0;
        $faturamentoMes = $estatisticasVendas['valor_mes_atual'] ?? 0;

        // Buscar dados recentes
        $veiculosRecentes = $this->veiculoService->buscarVeiculosRecentes(5);
        $clientesRecentes = $this->clienteService->buscarClientesRecentes(5);

        return view('dashboard', compact(
            'veiculosDisponiveis',
            'totalClientes',
            'vendasMes',
            'faturamentoMes',
            'veiculosRecentes', 
            'clientesRecentes'
        ));
    }
}
