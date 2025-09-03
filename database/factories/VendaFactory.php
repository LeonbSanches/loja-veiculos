<?php

namespace Database\Factories;

use App\Models\Venda;
use App\Models\Veiculo;
use App\Models\Cliente;
use App\Models\User;
use App\Models\MetodoPagamento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venda>
 */
class VendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $valorVenda = fake()->numberBetween(30000, 150000);
        $entrada = fake()->numberBetween(5000, $valorVenda * 0.3);
        $valorFinanciado = $valorVenda - $entrada;

        return [
            'veiculo_id' => Veiculo::factory(),
            'cliente_id' => Cliente::factory(),
            'user_id' => User::factory(),
            'valor_venda' => $valorVenda,
            'entrada' => $entrada,
            'valor_financiado' => $valorFinanciado,
            'metodo_pagamento_id' => MetodoPagamento::inRandomOrder()->first()?->id ?? 1,
            'data_venda' => fake()->dateTimeBetween('-1 year', 'now'),
            'observacoes' => fake()->optional(0.6)->sentence(),
        ];
    }

    /**
     * Indicate that the sale is from a specific vehicle.
     */
    public function forVeiculo(Veiculo $veiculo): static
    {
        return $this->state(fn (array $attributes) => [
            'veiculo_id' => $veiculo->id,
        ]);
    }

    /**
     * Indicate that the sale is to a specific client.
     */
    public function forCliente(Cliente $cliente): static
    {
        return $this->state(fn (array $attributes) => [
            'cliente_id' => $cliente->id,
        ]);
    }

    /**
     * Indicate that the sale is by a specific user.
     */
    public function byUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Indicate that the sale is from a specific date.
     */
    public function fromDate(string $date): static
    {
        return $this->state(fn (array $attributes) => [
            'data_venda' => $date,
        ]);
    }
}
