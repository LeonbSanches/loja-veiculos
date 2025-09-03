<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VeiculoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $veiculoId = $this->route('veiculo');
        
        return [
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'versao' => 'nullable|string|max:100',
            'ano_fab' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'ano_modelo' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'km' => 'required|integer|min:0',
            'cor' => 'required|string|max:50',
            'chassi' => [
                'required',
                'string',
                'size:17',
                Rule::unique('veiculos')->ignore($veiculoId),
            ],
            'placa' => [
                'required',
                'string',
                'regex:/^[A-Z]{3}[0-9][0-9A-Z][0-9]{2}$/',
                Rule::unique('veiculos')->ignore($veiculoId),
            ],
            'preco_compra' => 'required|numeric|min:0',
            'preco_venda' => 'required|numeric|min:0|gte:preco_compra',
            'status_id' => 'required|exists:status_veiculos,id',
            'observacoes' => 'nullable|string|max:1000',
            'foto_principal' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'marca.required' => 'A marca é obrigatória.',
            'modelo.required' => 'O modelo é obrigatório.',
            'ano_fab.required' => 'O ano de fabricação é obrigatório.',
            'ano_fab.min' => 'O ano de fabricação deve ser maior que 1900.',
            'ano_fab.max' => 'O ano de fabricação não pode ser maior que o próximo ano.',
            'ano_modelo.required' => 'O ano do modelo é obrigatório.',
            'ano_modelo.min' => 'O ano do modelo deve ser maior que 1900.',
            'ano_modelo.max' => 'O ano do modelo não pode ser maior que o próximo ano.',
            'km.required' => 'A quilometragem é obrigatória.',
            'km.min' => 'A quilometragem deve ser maior ou igual a 0.',
            'cor.required' => 'A cor é obrigatória.',
            'chassi.required' => 'O chassi é obrigatório.',
            'chassi.size' => 'O chassi deve ter exatamente 17 caracteres.',
            'chassi.unique' => 'Este chassi já está cadastrado.',
            'placa.required' => 'A placa é obrigatória.',
            'placa.regex' => 'A placa deve estar no formato Mercosul (ABC1D23).',
            'placa.unique' => 'Esta placa já está cadastrada.',
            'preco_compra.required' => 'O preço de compra é obrigatório.',
            'preco_compra.min' => 'O preço de compra deve ser maior ou igual a 0.',
            'preco_venda.required' => 'O preço de venda é obrigatório.',
            'preco_venda.min' => 'O preço de venda deve ser maior ou igual a 0.',
            'preco_venda.gte' => 'O preço de venda deve ser maior ou igual ao preço de compra.',
            'status_id.required' => 'O status é obrigatório.',
            'status_id.exists' => 'O status selecionado não existe.',
            'foto_principal.image' => 'O arquivo deve ser uma imagem.',
            'foto_principal.mimes' => 'A imagem deve ser do tipo: jpeg, png ou jpg.',
            'foto_principal.max' => 'A imagem não pode ter mais que 2MB.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'marca' => 'marca',
            'modelo' => 'modelo',
            'versao' => 'versão',
            'ano_fab' => 'ano de fabricação',
            'ano_modelo' => 'ano do modelo',
            'km' => 'quilometragem',
            'cor' => 'cor',
            'chassi' => 'chassi',
            'placa' => 'placa',
            'preco_compra' => 'preço de compra',
            'preco_venda' => 'preço de venda',
            'status_id' => 'status',
            'observacoes' => 'observações',
            'foto_principal' => 'foto principal',
        ];
    }
}
