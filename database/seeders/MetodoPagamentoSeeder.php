<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MetodoPagamento;

class MetodoPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metodos = [
            [
                'nome' => 'PIX',
                'codigo' => 'pix',
                'cor' => '#32CD32',
                'icone' => '📱',
                'descricao' => 'Pagamento via PIX',
                'ativo' => true,
                'ordem' => 1,
            ],
            [
                'nome' => 'Boleto',
                'codigo' => 'boleto',
                'cor' => '#FF8C00',
                'icone' => '📄',
                'descricao' => 'Pagamento via boleto bancário',
                'ativo' => true,
                'ordem' => 2,
            ],
            [
                'nome' => 'Financiamento',
                'codigo' => 'financiamento',
                'cor' => '#4169E1',
                'icone' => '🏦',
                'descricao' => 'Financiamento bancário',
                'ativo' => true,
                'ordem' => 3,
            ],
            [
                'nome' => 'Dinheiro',
                'codigo' => 'dinheiro',
                'cor' => '#228B22',
                'icone' => '💵',
                'descricao' => 'Pagamento em dinheiro',
                'ativo' => true,
                'ordem' => 4,
            ],
            [
                'nome' => 'Cartão de Crédito',
                'codigo' => 'cartao_credito',
                'cor' => '#FF1493',
                'icone' => '💳',
                'descricao' => 'Pagamento via cartão de crédito',
                'ativo' => true,
                'ordem' => 5,
            ],
            [
                'nome' => 'Cartão de Débito',
                'codigo' => 'cartao_debito',
                'cor' => '#8A2BE2',
                'icone' => '💳',
                'descricao' => 'Pagamento via cartão de débito',
                'ativo' => true,
                'ordem' => 6,
            ],
        ];

        foreach ($metodos as $item) {
            MetodoPagamento::updateOrCreate(
                ['codigo' => $item['codigo']],
                $item
            );
        }
    }
}
