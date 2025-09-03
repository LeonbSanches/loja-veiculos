<?php

namespace Database\Factories;

use App\Models\Veiculo;
use App\Models\StatusVeiculo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Veiculo>
 */
class VeiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $marcas = ['Toyota', 'Honda', 'Volkswagen', 'Ford', 'Chevrolet', 'Fiat', 'Hyundai', 'Nissan'];
        $modelos = ['Corolla', 'Civic', 'Golf', 'Focus', 'Cruze', 'Palio', 'HB20', 'Sentra'];
        $cores = ['Branco', 'Preto', 'Prata', 'Vermelho', 'Azul', 'Cinza', 'Verde', 'Amarelo'];
        
        $marca = fake()->randomElement($marcas);
        $modelo = fake()->randomElement($modelos);
        $ano = fake()->numberBetween(2015, 2024);
        $km = fake()->numberBetween(0, 150000);
        $precoCompra = fake()->numberBetween(30000, 120000);
        $precoVenda = $precoCompra + fake()->numberBetween(5000, 20000);

        return [
            'marca' => $marca,
            'modelo' => $modelo,
            'versao' => fake()->randomElement(['Base', 'Comfort', 'Luxo', 'Sport', 'Premium']),
            'ano_fab' => $ano,
            'ano_modelo' => $ano + fake()->numberBetween(0, 1),
            'km' => $km,
            'cor' => fake()->randomElement($cores),
            'chassi' => fake()->unique()->regexify('[A-HJ-NPR-Z0-9]{17}'),
            'placa' => fake()->unique()->regexify('[A-Z]{3}[0-9][A-Z0-9][0-9]{2}'),
            'preco_compra' => $precoCompra,
            'preco_venda' => $precoVenda,
            'status_id' => StatusVeiculo::inRandomOrder()->first()?->id ?? 1,
            'observacoes' => fake()->optional(0.7)->sentence(),
            'foto_principal' => null,
        ];
    }

    /**
     * Indicate that the vehicle is available.
     */
    public function disponivel(): static
    {
        return $this->state(fn (array $attributes) => [
            'status_id' => StatusVeiculo::where('codigo', 'disponivel')->first()?->id ?? 1,
        ]);
    }

    /**
     * Indicate that the vehicle is sold.
     */
    public function vendido(): static
    {
        return $this->state(fn (array $attributes) => [
            'status_id' => StatusVeiculo::where('codigo', 'vendido')->first()?->id ?? 3,
        ]);
    }

    /**
     * Indicate that the vehicle is reserved.
     */
    public function reservado(): static
    {
        return $this->state(fn (array $attributes) => [
            'status_id' => StatusVeiculo::where('codigo', 'reservado')->first()?->id ?? 2,
        ]);
    }
}
