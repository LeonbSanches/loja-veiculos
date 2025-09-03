<?php

namespace App\Http\Controllers;

use App\Services\VeiculoService;
use App\Services\ClienteService;
use App\Services\VendaService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RelatorioController extends Controller
{
    public function __construct(
        private VeiculoService $veiculoService,
        private ClienteService $clienteService,
        private VendaService $vendaService
    ) {}

    /**
     * Exibir página principal de relatórios
     */
    public function index(): View
    {
        return view('relatorios.index');
    }

    /**
     * Relatório de veículos
     */
    public function veiculos(Request $request): View
    {
        $filtros = $request->only([
            'marca', 'modelo', 'status_id', 'ano_min', 'ano_max'
        ]);

        // Buscar veículos com filtros
        $veiculos = $this->veiculoService->buscarVeiculos($filtros, 50);
        
        // Buscar estatísticas
        $estatisticas = $this->veiculoService->buscarEstatisticas();
        
        // Buscar status disponíveis para filtros
        $statusDisponiveis = $this->veiculoService->buscarStatusDisponiveis();
        
        // Calcular valor total do estoque
        $valorTotalEstoque = $veiculos->sum('preco_venda');

        return view('relatorios.veiculos', compact(
            'veiculos',
            'estatisticas',
            'statusDisponiveis',
            'valorTotalEstoque',
            'filtros'
        ));
    }

    /**
     * Relatório de clientes
     */
    public function clientes(Request $request): View
    {
        $filtros = $request->only([
            'nome', 'email', 'tipo_cliente_id', 'cidade'
        ]);

        // Buscar clientes com filtros
        $clientes = $this->clienteService->buscarClientes($filtros, 50);
        
        // Buscar estatísticas
        $estatisticas = $this->clienteService->buscarEstatisticas();
        
        // Buscar tipos disponíveis para filtros
        $tiposDisponiveis = $this->clienteService->buscarTiposDisponiveis();

        // Dados para gráfico de cidades
        $cidadesData = $this->clienteService->buscarDistribuicaoCidades();

        return view('relatorios.clientes', compact(
            'clientes',
            'estatisticas',
            'tiposDisponiveis',
            'cidadesData',
            'filtros'
        ));
    }

    /**
     * Relatório de vendas
     */
    public function vendas(Request $request): View
    {
        $filtros = $request->only([
            'data_inicio', 'data_fim', 'metodo_pagamento_id'
        ]);

        // Buscar vendas com filtros
        $vendas = $this->vendaService->buscarVendas($filtros, 50);
        
        // Buscar estatísticas
        $estatisticas = $this->vendaService->buscarEstatisticas();
        
        // Buscar métodos de pagamento disponíveis para filtros
        $metodosDisponiveis = $this->vendaService->buscarMetodosDisponiveis();

        // Dados para gráficos
        $vendasPorMes = $this->vendaService->buscarVendasPorMes();
        $vendasPorMetodo = $this->vendaService->buscarVendasPorMetodo();

        return view('relatorios.vendas', compact(
            'vendas',
            'estatisticas',
            'metodosDisponiveis',
            'vendasPorMes',
            'vendasPorMetodo',
            'filtros'
        ));
    }
}
