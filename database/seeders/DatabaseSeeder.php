<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Veiculo;
use App\Models\Cliente;
use App\Models\Venda;
use App\Models\StatusVeiculo;
use App\Models\MetodoPagamento;
use App\Models\TipoCliente;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Executar seeders das tabelas auxiliares primeiro
        $this->call([
            StatusVeiculoSeeder::class,
            MetodoPagamentoSeeder::class,
            TipoClienteSeeder::class,
        ]);

        // Criar usuário de teste
        User::updateOrCreate(
            ['email' => 'admin@loja.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@loja.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // Criar dados de exemplo se não existirem
        if (Veiculo::count() === 0) {
            $this->criarVeiculosExemplo();
        }

        if (Cliente::count() === 0) {
            $this->criarClientesExemplo();
        }
    }

    /**
     * Criar veículos de exemplo
     */
    private function criarVeiculosExemplo(): void
    {
        $statusDisponivel = StatusVeiculo::where('codigo', 'disponivel')->first();
        
        $veiculos = [
            [
                'marca' => 'Toyota',
                'modelo' => 'Corolla',
                'versao' => 'XEi 2.0',
                'ano_fab' => 2022,
                'ano_modelo' => 2023,
                'km' => 15000,
                'cor' => 'Prata',
                'chassi' => '9BWZZZ377VT004251',
                'placa' => 'ABC1D23',
                'preco_compra' => 85000.00,
                'preco_venda' => 95000.00,
                'status_id' => $statusDisponivel->id,
                'observacoes' => 'Veículo em excelente estado, único dono',
            ],
            [
                'marca' => 'Honda',
                'modelo' => 'Civic',
                'versao' => 'EXL 2.0',
                'ano_fab' => 2021,
                'ano_modelo' => 2022,
                'km' => 25000,
                'cor' => 'Preto',
                'chassi' => '1HGBH41JXMN109186',
                'placa' => 'DEF4G56',
                'preco_compra' => 78000.00,
                'preco_venda' => 88000.00,
                'status_id' => $statusDisponivel->id,
                'observacoes' => 'Veículo bem conservado, revisões em dia',
            ],
            [
                'marca' => 'Volkswagen',
                'modelo' => 'Golf',
                'versao' => 'GTI 2.0',
                'ano_fab' => 2020,
                'ano_modelo' => 2021,
                'km' => 35000,
                'cor' => 'Branco',
                'chassi' => '3VWLL7AJ4BM053165',
                'placa' => 'GHI7H89',
                'preco_compra' => 95000.00,
                'preco_venda' => 105000.00,
                'status_id' => $statusDisponivel->id,
                'observacoes' => 'Veículo esportivo, performance excepcional',
            ],
        ];

        foreach ($veiculos as $veiculo) {
            Veiculo::create($veiculo);
        }
    }

    /**
     * Criar clientes de exemplo
     */
    private function criarClientesExemplo(): void
    {
        $tipoPF = TipoCliente::where('codigo', 'PF')->first();
        $tipoPJ = TipoCliente::where('codigo', 'PJ')->first();

        $clientes = [
            [
                'tipo_cliente_id' => $tipoPF->id,
                'nome' => 'João Silva',
                'email' => 'joao.silva@email.com',
                'telefone' => '11999887766',
                'celular' => '11999887766',
                'cpf' => '123.456.789-01',
                'rg' => '12.345.678-9',
                'data_nascimento' => '1985-05-15',
                'endereco' => 'Rua das Flores',
                'numero' => '123',
                'complemento' => 'Apto 45',
                'bairro' => 'Centro',
                'cidade' => 'São Paulo',
                'estado' => 'SP',
                'cep' => '01234-567',
                'observacoes' => 'Cliente preferencial',
            ],
            [
                'tipo_cliente_id' => $tipoPF->id,
                'nome' => 'Maria Santos',
                'email' => 'maria.santos@email.com',
                'telefone' => '11888776655',
                'celular' => '11888776655',
                'cpf' => '987.654.321-00',
                'rg' => '98.765.432-1',
                'data_nascimento' => '1990-08-22',
                'endereco' => 'Av. Paulista',
                'numero' => '1000',
                'complemento' => null,
                'bairro' => 'Bela Vista',
                'cidade' => 'São Paulo',
                'estado' => 'SP',
                'cep' => '01310-100',
                'observacoes' => null,
            ],
            [
                'tipo_cliente_id' => $tipoPJ->id,
                'nome' => 'Empresa ABC Ltda',
                'email' => 'contato@empresaabc.com.br',
                'telefone' => '1133221144',
                'celular' => '1133221144',
                'cpf' => null,
                'rg' => null,
                'data_nascimento' => null,
                'endereco' => 'Rua Augusta',
                'numero' => '500',
                'complemento' => 'Sala 201',
                'bairro' => 'Consolação',
                'cidade' => 'São Paulo',
                'estado' => 'SP',
                'cep' => '01412-000',
                'observacoes' => 'Empresa parceira',
            ],
        ];

        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }
    }
}
