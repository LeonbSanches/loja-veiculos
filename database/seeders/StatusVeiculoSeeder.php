<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StatusVeiculo;

class StatusVeiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            [
                'nome' => 'Disponível',
                'codigo' => 'disponivel',
                'cor' => '#28a745',
                'icone' => '🚗',
                'descricao' => 'Veículo disponível para venda',
                'ativo' => true,
                'ordem' => 1,
            ],
            [
                'nome' => 'Reservado',
                'codigo' => 'reservado',
                'cor' => '#ffc107',
                'icone' => '🔒',
                'descricao' => 'Veículo reservado para cliente',
                'ativo' => true,
                'ordem' => 2,
            ],
            [
                'nome' => 'Vendido',
                'codigo' => 'vendido',
                'cor' => '#dc3545',
                'icone' => '✅',
                'descricao' => 'Veículo já foi vendido',
                'ativo' => true,
                'ordem' => 3,
            ],
            [
                'nome' => 'Consignado',
                'codigo' => 'consignado',
                'cor' => '#17a2b8',
                'icone' => '🤝',
                'descricao' => 'Veículo em consignação',
                'ativo' => true,
                'ordem' => 4,
            ],
            [
                'nome' => 'Manutenção',
                'codigo' => 'manutencao',
                'cor' => '#6c757d',
                'icone' => '🔧',
                'descricao' => 'Veículo em manutenção',
                'ativo' => true,
                'ordem' => 5,
            ],
        ];

        foreach ($status as $item) {
            StatusVeiculo::updateOrCreate(
                ['codigo' => $item['codigo']],
                $item
            );
        }
    }
}
