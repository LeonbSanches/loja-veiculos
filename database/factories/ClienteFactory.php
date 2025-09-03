<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\TipoCliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipoCliente = TipoCliente::inRandomOrder()->first();
        $isPF = $tipoCliente && $tipoCliente->codigo === 'PF';

        return [
            'tipo_cliente_id' => $tipoCliente?->id ?? 1,
            'nome' => $isPF ? fake()->name() : fake()->company(),
            'email' => fake()->unique()->safeEmail(),
            'telefone' => fake()->phoneNumber(),
            'celular' => fake()->optional(0.8)->phoneNumber(),
            'cpf' => $isPF ? fake()->unique()->numerify('###.###.###-##') : null,
            'rg' => $isPF ? fake()->optional(0.7)->numerify('##.###.###-#') : null,
            'data_nascimento' => $isPF ? fake()->optional(0.8)->date('Y-m-d', '2000-01-01') : null,
            'endereco' => fake()->streetName(),
            'numero' => fake()->buildingNumber(),
            'complemento' => fake()->optional(0.3)->secondaryAddress(),
            'bairro' => fake()->citySuffix(),
            'cidade' => fake()->city(),
            'estado' => fake()->stateAbbr(),
            'cep' => fake()->postcode(),
            'observacoes' => fake()->optional(0.4)->sentence(),
        ];
    }

    /**
     * Indicate that the client is a physical person.
     */
    public function pessoaFisica(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo_cliente_id' => TipoCliente::where('codigo', 'PF')->first()?->id ?? 1,
            'nome' => fake()->name(),
            'cpf' => fake()->unique()->numerify('###.###.###-##'),
            'rg' => fake()->optional(0.7)->numerify('##.###.###-#'),
            'data_nascimento' => fake()->optional(0.8)->date('Y-m-d', '2000-01-01'),
        ]);
    }

    /**
     * Indicate that the client is a legal person.
     */
    public function pessoaJuridica(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo_cliente_id' => TipoCliente::where('codigo', 'PJ')->first()?->id ?? 2,
            'nome' => fake()->company(),
            'cpf' => null,
            'rg' => null,
            'data_nascimento' => null,
        ]);
    }
}
