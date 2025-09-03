<?php

namespace App\Http\Controllers;

use App\Http\Requests\VeiculoRequest;
use App\Models\Veiculo;
use App\Services\VeiculoService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

class VeiculoController extends Controller
{
    public function __construct(
        private VeiculoService $veiculoService
    ) {}

    /**
     * Exibir lista de veículos
     */
    public function index(Request $request): View
    {
        $filtros = $request->only([
            'marca', 'modelo', 'status_id', 'ano_min', 'ano_max', 'preco_min', 'preco_max'
        ]);

        $veiculos = $this->veiculoService->buscarVeiculos($filtros);
        $statusDisponiveis = $this->veiculoService->buscarStatusDisponiveis();

        return view('veiculos.index', compact('veiculos', 'statusDisponiveis', 'filtros'));
    }

    /**
     * Exibir veículos disponíveis (público)
     */
    public function disponiveis(Request $request): View
    {
        $filtros = $request->only([
            'marca', 'modelo', 'ano_min', 'ano_max', 'preco_min', 'preco_max'
        ]);

        $veiculos = $this->veiculoService->buscarVeiculosDisponiveis($filtros);
        
        return view('veiculos.disponiveis', compact('veiculos', 'filtros'));
    }

    /**
     * Exibir formulário de criação
     */
    public function create(): View
    {
        $statusDisponiveis = $this->veiculoService->buscarStatusDisponiveis();
        
        return view('veiculos.create', compact('statusDisponiveis'));
    }

    /**
     * Armazenar novo veículo
     */
    public function store(VeiculoRequest $request): RedirectResponse
    {
        try {
            $dados = $request->validated();
            $veiculo = $this->veiculoService->criarVeiculo($dados);

            return redirect()
                ->route('veiculos.show', $veiculo)
                ->with('success', 'Veículo cadastrado com sucesso!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao cadastrar veículo: ' . $e->getMessage());
        }
    }

    /**
     * Exibir veículo específico
     */
    public function show(Veiculo $veiculo): View
    {
        $veiculo->load(['status', 'fotos', 'vendas.cliente', 'vendas.vendedor']);
        
        return view('veiculos.show', compact('veiculo'));
    }

    /**
     * Exibir formulário de edição
     */
    public function edit(Veiculo $veiculo): View
    {
        $statusDisponiveis = $this->veiculoService->buscarStatusDisponiveis();
        
        return view('veiculos.edit', compact('veiculo', 'statusDisponiveis'));
    }

    /**
     * Atualizar veículo
     */
    public function update(VeiculoRequest $request, Veiculo $veiculo): RedirectResponse
    {
        try {
            $dados = $request->validated();
            $this->veiculoService->atualizarVeiculo($veiculo, $dados);

            return redirect()
                ->route('veiculos.show', $veiculo)
                ->with('success', 'Veículo atualizado com sucesso!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar veículo: ' . $e->getMessage());
        }
    }

    /**
     * Excluir veículo
     */
    public function destroy(Veiculo $veiculo): RedirectResponse
    {
        try {
            $this->veiculoService->excluirVeiculo($veiculo);

            return redirect()
                ->route('veiculos.index')
                ->with('success', 'Veículo excluído com sucesso!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erro ao excluir veículo: ' . $e->getMessage());
        }
    }

    /**
     * Alterar status do veículo
     */
    public function alterarStatus(Request $request, Veiculo $veiculo): RedirectResponse
    {
        $request->validate([
            'status_id' => 'required|exists:status_veiculos,id'
        ]);

        try {
            $this->veiculoService->alterarStatus($veiculo, $request->status_id);

            return redirect()
                ->back()
                ->with('success', 'Status do veículo alterado com sucesso!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erro ao alterar status: ' . $e->getMessage());
        }
    }

    /**
     * Buscar veículos via AJAX
     */
    public function buscar(Request $request)
    {
        $filtros = $request->only([
            'marca', 'modelo', 'status_id', 'ano_min', 'ano_max', 'preco_min', 'preco_max'
        ]);

        $veiculos = $this->veiculoService->buscarVeiculos($filtros, 12);

        return response()->json([
            'veiculos' => $veiculos->items(),
            'pagination' => [
                'current_page' => $veiculos->currentPage(),
                'last_page' => $veiculos->lastPage(),
                'per_page' => $veiculos->perPage(),
                'total' => $veiculos->total(),
            ]
        ]);
    }

    /**
     * Dashboard com estatísticas
     */
    public function dashboard(): View
    {
        $estatisticas = $this->veiculoService->buscarEstatisticas();
        $veiculosRecentes = $this->veiculoService->buscarVeiculosRecentes(5);
        $statusDisponiveis = $this->veiculoService->buscarStatusDisponiveis();

        return view('veiculos.dashboard', compact('estatisticas', 'veiculosRecentes', 'statusDisponiveis'));
    }

    /**
     * Adicionar foto ao veículo
     */
    public function adicionarFoto(Request $request, Veiculo $veiculo): RedirectResponse
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'descricao' => 'nullable|string|max:255',
            'principal' => 'boolean'
        ]);

        try {
            $this->veiculoService->salvarFoto($veiculo, $request->file('foto'), $request->descricao, $request->boolean('principal'));

            return redirect()
                ->back()
                ->with('success', 'Foto adicionada com sucesso!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erro ao adicionar foto: ' . $e->getMessage());
        }
    }

    /**
     * Remover foto do veículo
     */
    public function removerFoto(Veiculo $veiculo, $fotoId): RedirectResponse
    {
        try {
            $this->veiculoService->removerFoto($veiculo, $fotoId);

            return redirect()
                ->back()
                ->with('success', 'Foto removida com sucesso!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erro ao remover foto: ' . $e->getMessage());
        }
    }

    /**
     * Definir foto como principal
     */
    public function definirFotoPrincipal(Veiculo $veiculo, $fotoId): RedirectResponse
    {
        try {
            $this->veiculoService->definirFotoPrincipal($veiculo, $fotoId);

            return redirect()
                ->back()
                ->with('success', 'Foto principal definida com sucesso!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erro ao definir foto principal: ' . $e->getMessage());
        }
    }
}
