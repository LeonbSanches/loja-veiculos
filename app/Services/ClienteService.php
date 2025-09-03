<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\TipoCliente;
use Illuminate\Support\Facades\DB;
use Exception;

class ClienteService
{
    /**
     * Buscar todos os clientes com paginação e filtros
     */
    public function buscarClientes(array $filtros = [], int $porPagina = 15)
    {
        $query = Cliente::with(['tipoCliente', 'vendas']);

        // Aplicar filtros
        if (!empty($filtros['nome'])) {
            $query->where('nome', 'like', "%{$filtros['nome']}%");
        }

        if (!empty($filtros['email'])) {
            $query->where('email', 'like', "%{$filtros['email']}%");
        }

        if (!empty($filtros['cpf'])) {
            $query->where('cpf', 'like', "%{$filtros['cpf']}%");
        }

        if (!empty($filtros['tipo_cliente_id'])) {
            $query->where('tipo_cliente_id', $filtros['tipo_cliente_id']);
        }

        if (!empty($filtros['cidade'])) {
            $query->where('cidade', 'like', "%{$filtros['cidade']}%");
        }

        return $query->orderBy('nome')
                    ->paginate($porPagina);
    }

    /**
     * Criar um novo cliente
     */
    public function criarCliente(array $dados): Cliente
    {
        DB::beginTransaction();

        try {
            $cliente = Cliente::create($dados);

            DB::commit();
            return $cliente;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Atualizar um cliente existente
     */
    public function atualizarCliente(Cliente $cliente, array $dados): Cliente
    {
        DB::beginTransaction();

        try {
            $cliente->update($dados);

            DB::commit();
            return $cliente;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Excluir um cliente
     */
    public function excluirCliente(Cliente $cliente): bool
    {
        DB::beginTransaction();

        try {
            // Verificar se o cliente pode ser excluído
            if ($cliente->vendas()->exists()) {
                throw new Exception('Não é possível excluir um cliente que possui vendas registradas.');
            }

            $cliente->delete();

            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Buscar cliente por CPF
     */
    public function buscarPorCpf(string $cpf): ?Cliente
    {
        return Cliente::where('cpf', $cpf)->first();
    }

    /**
     * Buscar cliente por email
     */
    public function buscarPorEmail(string $email): ?Cliente
    {
        return Cliente::where('email', $email)->first();
    }

    /**
     * Buscar todos os tipos de cliente disponíveis
     */
    public function buscarTiposDisponiveis()
    {
        return TipoCliente::ativos()->ordenados()->get();
    }

    /**
     * Buscar distribuição de clientes por cidade
     */
    public function buscarDistribuicaoCidades()
    {
        return Cliente::selectRaw('cidade, COUNT(*) as total')
            ->groupBy('cidade')
            ->orderBy('total', 'desc')
            ->limit(6)
            ->get();
    }

    /**
     * Buscar estatísticas dos clientes
     */
    public function buscarEstatisticas(): array
    {
        $estatisticas = [];
        
        $tiposClientes = TipoCliente::ativos()->get();
        
        foreach ($tiposClientes as $tipo) {
            $estatisticas[$tipo->codigo] = Cliente::where('tipo_cliente_id', $tipo->id)->count();
        }
        
        $estatisticas['total'] = Cliente::count();
        $estatisticas['com_vendas'] = Cliente::whereHas('vendas')->count();
        $estatisticas['sem_vendas'] = Cliente::whereDoesntHave('vendas')->count();
        
        return $estatisticas;
    }

    /**
     * Buscar clientes recentes
     */
    public function buscarClientesRecentes(int $limite = 5)
    {
        return Cliente::with(['tipoCliente'])
                    ->orderBy('created_at', 'desc')
                    ->limit($limite)
                    ->get();
    }

    /**
     * Buscar clientes com mais vendas
     */
    public function buscarClientesTopVendas(int $limite = 5)
    {
        return Cliente::with(['tipoCliente'])
                    ->withCount('vendas')
                    ->orderBy('vendas_count', 'desc')
                    ->limit($limite)
                    ->get();
    }
}
