<?php

namespace App\Services;

use App\Models\Venda;
use App\Models\Veiculo;
use App\Models\Cliente;
use App\Models\MetodoPagamento;
use Illuminate\Support\Facades\DB;
use Exception;

class VendaService
{
    /**
     * Buscar todas as vendas com paginação e filtros
     */
    public function buscarVendas(array $filtros = [], int $porPagina = 15)
    {
        $query = Venda::with(['veiculo', 'cliente', 'vendedor', 'metodoPagamento']);

        // Aplicar filtros
        if (!empty($filtros['cliente_id'])) {
            $query->where('cliente_id', $filtros['cliente_id']);
        }

        if (!empty($filtros['veiculo_id'])) {
            $query->where('veiculo_id', $filtros['veiculo_id']);
        }

        if (!empty($filtros['user_id'])) {
            $query->where('user_id', $filtros['user_id']);
        }

        if (!empty($filtros['metodo_pagamento_id'])) {
            $query->where('metodo_pagamento_id', $filtros['metodo_pagamento_id']);
        }

        if (!empty($filtros['data_inicio'])) {
            $query->where('data_venda', '>=', $filtros['data_inicio']);
        }

        if (!empty($filtros['data_fim'])) {
            $query->where('data_venda', '<=', $filtros['data_fim']);
        }

        if (!empty($filtros['valor_min'])) {
            $query->where('valor_venda', '>=', $filtros['valor_min']);
        }

        if (!empty($filtros['valor_max'])) {
            $query->where('valor_venda', '<=', $filtros['valor_max']);
        }

        return $query->orderBy('data_venda', 'desc')
                    ->paginate($porPagina);
    }

    /**
     * Criar uma nova venda
     */
    public function criarVenda(array $dados): Venda
    {
        DB::beginTransaction();

        try {
            // Adicionar o vendedor atual
            $dados['user_id'] = auth()->id();

            // Criar a venda
            $venda = Venda::create($dados);

            // Atualizar status do veículo para vendido
            $veiculo = Veiculo::find($dados['veiculo_id']);
            if ($veiculo) {
                $statusVendido = \App\Models\StatusVeiculo::where('codigo', 'vendido')->first();
                if ($statusVendido) {
                    $veiculo->update(['status_id' => $statusVendido->id]);
                }
            }

            DB::commit();
            return $venda;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Atualizar uma venda existente
     */
    public function atualizarVenda(Venda $venda, array $dados): Venda
    {
        DB::beginTransaction();

        try {
            $venda->update($dados);

            DB::commit();
            return $venda;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Excluir uma venda
     */
    public function excluirVenda(Venda $venda): bool
    {
        DB::beginTransaction();

        try {
            // Reverter status do veículo para disponível
            $veiculo = $venda->veiculo;
            if ($veiculo) {
                $statusDisponivel = \App\Models\StatusVeiculo::where('codigo', 'disponivel')->first();
                if ($statusDisponivel) {
                    $veiculo->update(['status_id' => $statusDisponivel->id]);
                }
            }

            $venda->delete();

            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Buscar todos os métodos de pagamento disponíveis
     */
    public function buscarMetodosPagamento()
    {
        return MetodoPagamento::ativos()->ordenados()->get();
    }

    /**
     * Buscar métodos de pagamento disponíveis para filtros
     */
    public function buscarMetodosDisponiveis()
    {
        return MetodoPagamento::ativos()->ordenados()->get();
    }

    /**
     * Buscar estatísticas das vendas
     */
    public function buscarEstatisticas(): array
    {
        $estatisticas = [];
        
        // Vendas por mês (últimos 12 meses)
        $vendasPorMes = Venda::selectRaw('TO_CHAR(data_venda, \'YYYY-MM\') as mes, COUNT(*) as total, SUM(valor_venda) as valor_total')
            ->where('data_venda', '>=', now()->subMonths(12))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $estatisticas['vendas_por_mes'] = $vendasPorMes;
        
        // Vendas por método de pagamento
        $vendasPorMetodo = Venda::with('metodoPagamento')
            ->selectRaw('metodo_pagamento_id, COUNT(*) as total, SUM(valor_venda) as valor_total')
            ->groupBy('metodo_pagamento_id')
            ->get();

        $estatisticas['vendas_por_metodo'] = $vendasPorMetodo;
        
        // Totais gerais
        $estatisticas['total_vendas'] = Venda::count();
        $estatisticas['valor_total_vendas'] = Venda::sum('valor_venda');
        $estatisticas['valor_medio_venda'] = Venda::avg('valor_venda');
        
        // Vendas do mês atual
        $estatisticas['vendas_mes_atual'] = Venda::whereRaw('EXTRACT(MONTH FROM data_venda) = ? AND EXTRACT(YEAR FROM data_venda) = ?', [now()->month, now()->year])
            ->count();
        
        $estatisticas['valor_mes_atual'] = Venda::whereRaw('EXTRACT(MONTH FROM data_venda) = ? AND EXTRACT(YEAR FROM data_venda) = ?', [now()->month, now()->year])
            ->sum('valor_venda');
        
        return $estatisticas;
    }

    /**
     * Buscar vendas recentes
     */
    public function buscarVendasRecentes(int $limite = 5)
    {
        return Venda::with(['veiculo', 'cliente', 'vendedor', 'metodoPagamento'])
                    ->orderBy('data_venda', 'desc')
                    ->limit($limite)
                    ->get();
    }

    /**
     * Buscar vendas por mês (últimos 12 meses)
     */
    public function buscarVendasPorMes()
    {
        $vendasPorMes = Venda::selectRaw('EXTRACT(MONTH FROM data_venda) as mes, COUNT(*) as total')
            ->where('data_venda', '>=', now()->subMonths(12))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get()
            ->keyBy('mes');

        // Garantir que todos os meses tenham dados (mesmo que zero)
        $dadosCompletos = collect();
        for ($mes = 1; $mes <= 12; $mes++) {
            $vendaMes = $vendasPorMes->get($mes);
            $dadosCompletos->push([
                'mes' => $mes,
                'total' => $vendaMes ? $vendaMes->total : 0
            ]);
        }

        return $dadosCompletos;
    }

    /**
     * Buscar vendas por método de pagamento
     */
    public function buscarVendasPorMetodo()
    {
        return Venda::with('metodoPagamento')
            ->selectRaw('metodo_pagamento_id, COUNT(*) as total')
            ->groupBy('metodo_pagamento_id')
            ->get();
    }

    /**
     * Buscar vendas por período
     */
    public function buscarVendasPorPeriodo(string $dataInicio, string $dataFim)
    {
        return Venda::with(['veiculo', 'cliente', 'vendedor', 'metodoPagamento'])
                    ->whereBetween('data_venda', [$dataInicio, $dataFim])
                    ->orderBy('data_venda', 'desc')
                    ->get();
    }

    /**
     * Gerar relatório de vendas
     */
    public function gerarRelatorio(array $filtros = []): array
    {
        $query = Venda::with(['veiculo', 'cliente', 'vendedor', 'metodoPagamento']);

        // Aplicar filtros
        if (!empty($filtros['data_inicio'])) {
            $query->where('data_venda', '>=', $filtros['data_inicio']);
        }

        if (!empty($filtros['data_fim'])) {
            $query->where('data_venda', '<=', $filtros['data_fim']);
        }

        if (!empty($filtros['vendedor_id'])) {
            $query->where('user_id', $filtros['vendedor_id']);
        }

        $vendas = $query->orderBy('data_venda', 'desc')->get();

        $relatorio = [
            'vendas' => $vendas,
            'total_vendas' => $vendas->count(),
            'valor_total' => $vendas->sum('valor_venda'),
            'valor_medio' => $vendas->avg('valor_venda'),
            'periodo' => [
                'inicio' => $filtros['data_inicio'] ?? $vendas->min('data_venda'),
                'fim' => $filtros['data_fim'] ?? $vendas->max('data_venda'),
            ]
        ];

        return $relatorio;
    }
}
