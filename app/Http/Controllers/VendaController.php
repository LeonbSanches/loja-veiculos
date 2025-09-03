<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendaRequest;
use App\Models\Venda;
use App\Models\Veiculo;
use App\Models\Cliente;
use App\Services\VendaService;
use App\Services\VeiculoService;
use App\Services\ClienteService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

class VendaController extends Controller
{
    public function __construct(
        private VendaService $vendaService,
        private VeiculoService $veiculoService,
        private ClienteService $clienteService
    ) {}

    /**
     * Exibir lista de vendas
     */
    public function index(Request $request): View
    {
        $filtros = $request->only([
            'cliente_id', 'veiculo_id', 'user_id', 'metodo_pagamento_id',
            'data_inicio', 'data_fim', 'valor_min', 'valor_max'
        ]);

        $vendas = $this->vendaService->buscarVendas($filtros);
        $metodosPagamento = $this->vendaService->buscarMetodosPagamento();

        return view('vendas.index', compact('vendas', 'metodosPagamento', 'filtros'));
    }

    /**
     * Exibir formulário de criação
     */
    public function create(Request $request): View
    {
        $veiculoId = $request->get('veiculo_id');
        $clienteId = $request->get('cliente_id');

        $veiculos = Veiculo::disponiveis()->with('status')->get();
        $clientes = Cliente::orderBy('nome')->get();
        $metodosPagamento = $this->vendaService->buscarMetodosPagamento();

        $veiculoSelecionado = $veiculoId ? Veiculo::find($veiculoId) : null;
        $clienteSelecionado = $clienteId ? Cliente::find($clienteId) : null;

        return view('vendas.create', compact(
            'veiculos', 'clientes', 'metodosPagamento', 
            'veiculoSelecionado', 'clienteSelecionado'
        ));
    }

    /**
     * Armazenar nova venda
     */
    public function store(VendaRequest $request): RedirectResponse
    {
        try {
            $dados = $request->validated();
            $venda = $this->vendaService->criarVenda($dados);

            return redirect()
                ->route('vendas.show', $venda)
                ->with('success', 'Venda registrada com sucesso!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao registrar venda: ' . $e->getMessage());
        }
    }

    /**
     * Exibir venda específica
     */
    public function show(Venda $venda): View
    {
        $venda->load(['veiculo.status', 'cliente.tipoCliente', 'vendedor', 'metodoPagamento']);
        
        return view('vendas.show', compact('venda'));
    }

    /**
     * Exibir formulário de edição
     */
    public function edit(Venda $venda): View
    {
        $veiculos = Veiculo::with('status')->get();
        $clientes = Cliente::orderBy('nome')->get();
        $metodosPagamento = $this->vendaService->buscarMetodosPagamento();
        
        return view('vendas.edit', compact('venda', 'veiculos', 'clientes', 'metodosPagamento'));
    }

    /**
     * Atualizar venda
     */
    public function update(VendaRequest $request, Venda $venda): RedirectResponse
    {
        try {
            $dados = $request->validated();
            $this->vendaService->atualizarVenda($venda, $dados);

            return redirect()
                ->route('vendas.show', $venda)
                ->with('success', 'Venda atualizada com sucesso!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar venda: ' . $e->getMessage());
        }
    }

    /**
     * Excluir venda
     */
    public function destroy(Venda $venda): RedirectResponse
    {
        try {
            $this->vendaService->excluirVenda($venda);

            return redirect()
                ->route('vendas.index')
                ->with('success', 'Venda excluída com sucesso!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erro ao excluir venda: ' . $e->getMessage());
        }
    }

    /**
     * Buscar vendas via AJAX
     */
    public function buscar(Request $request)
    {
        $filtros = $request->only([
            'cliente_id', 'veiculo_id', 'user_id', 'metodo_pagamento_id',
            'data_inicio', 'data_fim', 'valor_min', 'valor_max'
        ]);

        $vendas = $this->vendaService->buscarVendas($filtros, 15);

        return response()->json([
            'vendas' => $vendas->items(),
            'pagination' => [
                'current_page' => $vendas->currentPage(),
                'last_page' => $vendas->lastPage(),
                'per_page' => $vendas->perPage(),
                'total' => $vendas->total(),
            ]
        ]);
    }

    /**
     * Dashboard com estatísticas
     */
    public function dashboard(): View
    {
        $estatisticas = $this->vendaService->buscarEstatisticas();
        $vendasRecentes = $this->vendaService->buscarVendasRecentes(5);
        $metodosPagamento = $this->vendaService->buscarMetodosPagamento();

        return view('vendas.dashboard', compact('estatisticas', 'vendasRecentes', 'metodosPagamento'));
    }

    /**
     * Gerar relatório de vendas
     */
    public function relatorio(Request $request): View
    {
        $filtros = $request->only([
            'data_inicio', 'data_fim', 'vendedor_id'
        ]);

        $relatorio = $this->vendaService->gerarRelatorio($filtros);

        return view('vendas.relatorio', compact('relatorio', 'filtros'));
    }

    /**
     * Exportar relatório para PDF
     */
    public function exportarRelatorio(Request $request)
    {
        $filtros = $request->only([
            'data_inicio', 'data_fim', 'vendedor_id'
        ]);

        $relatorio = $this->vendaService->gerarRelatorio($filtros);

        // Aqui você pode implementar a exportação para PDF usando uma biblioteca como DomPDF
        // Por enquanto, retornamos uma view com o relatório
        
        return view('vendas.relatorio-pdf', compact('relatorio', 'filtros'));
    }
}
