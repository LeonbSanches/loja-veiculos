<?php

namespace App\Services;

use App\Models\Veiculo;
use App\Models\VeiculoFoto;
use App\Models\StatusVeiculo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class VeiculoService
{
    /**
     * Buscar todos os veículos com paginação e filtros
     */
    public function buscarVeiculos(array $filtros = [], int $porPagina = 12)
    {
        $query = Veiculo::with(['status', 'fotos']);

        // Aplicar filtros
        if (!empty($filtros['marca'])) {
            $query->porMarca($filtros['marca']);
        }

        if (!empty($filtros['modelo'])) {
            $query->porModelo($filtros['modelo']);
        }

        if (!empty($filtros['status_id'])) {
            $query->where('status_id', $filtros['status_id']);
        }

        if (!empty($filtros['ano_min'])) {
            $query->where('ano_fab', '>=', $filtros['ano_min']);
        }

        if (!empty($filtros['ano_max'])) {
            $query->where('ano_fab', '<=', $filtros['ano_max']);
        }

        if (!empty($filtros['preco_min'])) {
            $query->where('preco_venda', '>=', $filtros['preco_min']);
        }

        if (!empty($filtros['preco_max'])) {
            $query->where('preco_venda', '<=', $filtros['preco_max']);
        }

        return $query->orderBy('created_at', 'desc')
                    ->paginate($porPagina);
    }

    /**
     * Buscar veículos disponíveis
     */
    public function buscarVeiculosDisponiveis(array $filtros = [], int $porPagina = 12)
    {
        $query = Veiculo::disponiveis()->with(['status', 'fotos']);

        // Aplicar filtros
        if (!empty($filtros['marca'])) {
            $query->porMarca($filtros['marca']);
        }

        if (!empty($filtros['modelo'])) {
            $query->porModelo($filtros['modelo']);
        }

        if (!empty($filtros['ano_min'])) {
            $query->where('ano_fab', '>=', $filtros['ano_min']);
        }

        if (!empty($filtros['ano_max'])) {
            $query->where('ano_fab', '<=', $filtros['ano_max']);
        }

        if (!empty($filtros['preco_min'])) {
            $query->where('preco_venda', '>=', $filtros['preco_min']);
        }

        if (!empty($filtros['preco_max'])) {
            $query->where('preco_venda', '<=', $filtros['preco_max']);
        }

        return $query->orderBy('created_at', 'desc')
                    ->paginate($porPagina);
    }

    /**
     * Criar um novo veículo
     */
    public function criarVeiculo(array $dados): Veiculo
    {
        DB::beginTransaction();

        try {
            // Processar foto principal se fornecida
            if (isset($dados['foto_principal']) && $dados['foto_principal'] instanceof UploadedFile) {
                $dados['foto_principal'] = $this->salvarFotoPrincipal($dados['foto_principal']);
            }

            $veiculo = Veiculo::create($dados);

            DB::commit();
            return $veiculo;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Atualizar um veículo existente
     */
    public function atualizarVeiculo(Veiculo $veiculo, array $dados): Veiculo
    {
        DB::beginTransaction();

        try {
            // Processar nova foto principal se fornecida
            if (isset($dados['foto_principal']) && $dados['foto_principal'] instanceof UploadedFile) {
                // Remover foto antiga
                if ($veiculo->foto_principal) {
                    $this->removerArquivoFoto($veiculo->foto_principal);
                }
                
                $dados['foto_principal'] = $this->salvarFotoPrincipal($dados['foto_principal']);
            }

            $veiculo->update($dados);

            DB::commit();
            return $veiculo;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Excluir um veículo
     */
    public function excluirVeiculo(Veiculo $veiculo): bool
    {
        DB::beginTransaction();

        try {
            // Verificar se o veículo pode ser excluído
            if ($veiculo->vendas()->exists()) {
                throw new Exception('Não é possível excluir um veículo que possui vendas registradas.');
            }

            // Remover fotos
            foreach ($veiculo->fotos as $foto) {
                $this->removerArquivoFoto($foto->foto);
            }

            // Remover foto principal
            if ($veiculo->foto_principal) {
                $this->removerFoto($veiculo->foto_principal);
            }

            $veiculo->delete();

            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Alterar status do veículo
     */
    public function alterarStatus(Veiculo $veiculo, int $novoStatusId): Veiculo
    {
        $status = StatusVeiculo::find($novoStatusId);
        
        if (!$status) {
            throw new Exception('Status inválido.');
        }

        $veiculo->update(['status_id' => $novoStatusId]);
        return $veiculo;
    }

    /**
     * Salvar foto principal do veículo
     */
    private function salvarFotoPrincipal(UploadedFile $foto): string
    {
        $nomeArquivo = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
        $caminho = $foto->storeAs('veiculos', $nomeArquivo, 'public');
        
        return $caminho;
    }

    /**
     * Remover arquivo de foto do storage
     */
    private function removerArquivoFoto(string $caminho): bool
    {
        if (Storage::disk('public')->exists($caminho)) {
            return Storage::disk('public')->delete($caminho);
        }
        
        return false;
    }

    /**
     * Buscar estatísticas dos veículos
     */
    public function buscarEstatisticas(): array
    {
        $estatisticas = [];
        
        $statusVeiculos = StatusVeiculo::ativos()->get();
        
        foreach ($statusVeiculos as $status) {
            $estatisticas[$status->codigo] = Veiculo::where('status_id', $status->id)->count();
        }
        
        $estatisticas['total'] = Veiculo::count();
        
        return $estatisticas;
    }

    /**
     * Buscar veículos recentes
     */
    public function buscarVeiculosRecentes(int $limite = 5): \Illuminate\Database\Eloquent\Collection
    {
        return Veiculo::with(['status', 'fotos'])
                    ->orderBy('created_at', 'desc')
                    ->limit($limite)
                    ->get();
    }

    /**
     * Buscar todos os status disponíveis
     */
    public function buscarStatusDisponiveis()
    {
        return StatusVeiculo::ativos()->ordenados()->get();
    }

    /**
     * Salvar foto do veículo
     */
    public function salvarFoto(Veiculo $veiculo, UploadedFile $foto, ?string $descricao = null, bool $principal = false): VeiculoFoto
    {
        DB::beginTransaction();
        
        try {
            // Se esta foto será principal, remover principal de outras fotos
            if ($principal) {
                $veiculo->fotos()->update(['principal' => false]);
            }

            // Salvar arquivo
            $caminho = $foto->store('veiculos/fotos', 'public');
            
            // Criar registro da foto
            $veiculoFoto = $veiculo->fotos()->create([
                'foto' => $caminho,
                'descricao' => $descricao,
                'principal' => $principal,
                'ordem' => $veiculo->fotos()->count() + 1
            ]);

            DB::commit();
            
            return $veiculoFoto;
            
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Remover foto do veículo
     */
    public function removerFoto(Veiculo $veiculo, int $fotoId): bool
    {
        DB::beginTransaction();
        
        try {
            $foto = $veiculo->fotos()->findOrFail($fotoId);
            
            // Remover arquivo do storage
            if (Storage::disk('public')->exists($foto->foto)) {
                Storage::disk('public')->delete($foto->foto);
            }
            
            // Remover registro
            $foto->delete();
            
            // Reordenar fotos restantes
            $this->reordenarFotos($veiculo);
            
            DB::commit();
            
            return true;
            
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Definir foto como principal
     */
    public function definirFotoPrincipal(Veiculo $veiculo, int $fotoId): bool
    {
        DB::beginTransaction();
        
        try {
            // Remover principal de todas as fotos
            $veiculo->fotos()->update(['principal' => false]);
            
            // Definir nova foto principal
            $foto = $veiculo->fotos()->findOrFail($fotoId);
            $foto->update(['principal' => true]);
            
            DB::commit();
            
            return true;
            
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Reordenar fotos do veículo
     */
    private function reordenarFotos(Veiculo $veiculo): void
    {
        $fotos = $veiculo->fotos()->orderBy('ordem')->orderBy('id')->get();
        
        foreach ($fotos as $index => $foto) {
            $foto->update(['ordem' => $index + 1]);
        }
    }
}
