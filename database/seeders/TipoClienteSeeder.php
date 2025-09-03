<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoCliente;

class TipoClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            [
                'nome' => 'Pessoa Física',
                'codigo' => 'PF',
                'cor' => '#007bff',
                'icone' => '👤',
                'descricao' => 'Cliente pessoa física (CPF)',
                'ativo' => true,
                'ordem' => 1,
            ],
            [
                'nome' => 'Pessoa Jurídica',
                'codigo' => 'PJ',
                'cor' => '#28a745',
                'icone' => '🏢',
                'descricao' => 'Cliente pessoa jurídica (CNPJ)',
                'ativo' => true,
                'ordem' => 2,
            ],
        ];

        foreach ($tipos as $item) {
            TipoCliente::updateOrCreate(
                ['codigo' => $item['codigo']],
                $item
            );
        }
    }
}
