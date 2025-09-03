<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Services\ClienteService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

class ClienteController extends Controller
{
    public function __construct(
        private ClienteService $clienteService
    ) {}

    /**
     * Exibir lista de clientes
     */
    public function index(Request $request): View
    {
        $filtros = $request->only([
            'nome', 'email', 'cpf', 'tipo_cliente_id', 'cidade'
        ]);

        $clientes = $this->clienteService->buscarClientes($filtros);
        $tiposDisponiveis = $this->clienteService->buscarTiposDisponiveis();

        return view('clientes.index', compact('clientes', 'tiposDisponiveis', 'filtros'));
    }

    /**
     * Exibir formulário de criação
     */
    public function create(): View
    {
        $tiposDisponiveis = $this->clienteService->buscarTiposDisponiveis();
        
        return view('clientes.create', compact('tiposDisponiveis'));
    }

    /**
     * Armazenar novo cliente
     */
    public function store(ClienteRequest $request): RedirectResponse
    {
        try {
            $dados = $request->validated();
            $cliente = $this->clienteService->criarCliente($dados);

            return redirect()
                ->route('clientes.show', $cliente)
                ->with('success', 'Cliente cadastrado com sucesso!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao cadastrar cliente: ' . $e->getMessage());
        }
    }

    /**
     * Exibir cliente específico
     */
    public function show(Cliente $cliente): View
    {
        $cliente->load(['tipoCliente', 'vendas.veiculo', 'vendas.vendedor', 'vendas.metodoPagamento']);
        
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Exibir formulário de edição
     */
    public function edit(Cliente $cliente): View
    {
        $tiposDisponiveis = $this->clienteService->buscarTiposDisponiveis();
        
        return view('clientes.edit', compact('cliente', 'tiposDisponiveis'));
    }

    /**
     * Atualizar cliente
     */
    public function update(ClienteRequest $request, Cliente $cliente): RedirectResponse
    {
        try {
            $dados = $request->validated();
            $this->clienteService->atualizarCliente($cliente, $dados);

            return redirect()
                ->route('clientes.show', $cliente)
                ->with('success', 'Cliente atualizado com sucesso!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar cliente: ' . $e->getMessage());
        }
    }

    /**
     * Excluir cliente
     */
    public function destroy(Cliente $cliente): RedirectResponse
    {
        try {
            $this->clienteService->excluirCliente($cliente);

            return redirect()
                ->route('clientes.index')
                ->with('success', 'Cliente excluído com sucesso!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erro ao excluir cliente: ' . $e->getMessage());
        }
    }

    /**
     * Buscar clientes via AJAX
     */
    public function buscar(Request $request)
    {
        $filtros = $request->only([
            'nome', 'email', 'cpf', 'tipo_cliente_id', 'cidade'
        ]);

        $clientes = $this->clienteService->buscarClientes($filtros, 15);

        return response()->json([
            'clientes' => $clientes->items(),
            'pagination' => [
                'current_page' => $clientes->currentPage(),
                'last_page' => $clientes->lastPage(),
                'per_page' => $clientes->perPage(),
                'total' => $clientes->total(),
            ]
        ]);
    }

    /**
     * Buscar cliente por CPF via AJAX
     */
    public function buscarPorCpf(Request $request)
    {
        $request->validate([
            'cpf' => 'required|string'
        ]);

        $cliente = $this->clienteService->buscarPorCpf($request->cpf);

        if ($cliente) {
            return response()->json([
                'encontrado' => true,
                'cliente' => $cliente
            ]);
        }

        return response()->json([
            'encontrado' => false,
            'message' => 'Cliente não encontrado'
        ]);
    }

    /**
     * Dashboard com estatísticas
     */
    public function dashboard(): View
    {
        $estatisticas = $this->clienteService->buscarEstatisticas();
        $clientesRecentes = $this->clienteService->buscarClientesRecentes(5);
        $clientesTopVendas = $this->clienteService->buscarClientesTopVendas(5);
        $tiposDisponiveis = $this->clienteService->buscarTiposDisponiveis();

        return view('clientes.dashboard', compact('estatisticas', 'clientesRecentes', 'clientesTopVendas', 'tiposDisponiveis'));
    }
}
