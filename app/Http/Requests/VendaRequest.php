<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendaRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'veiculo_id' => 'required|exists:veiculos,id',
            'cliente_id' => 'required|exists:clientes,id',
            'valor_venda' => 'required|numeric|min:0',
            'entrada' => 'required|numeric|min:0|lte:valor_venda',
            'valor_financiado' => 'required|numeric|min:0',
            'metodo_pagamento_id' => 'required|exists:metodo_pagamentos,id',
            'data_venda' => 'required|date|before_or_equal:today',
            'observacoes' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'veiculo_id.required' => 'O veículo é obrigatório.',
            'veiculo_id.exists' => 'O veículo selecionado não existe.',
            'cliente_id.required' => 'O cliente é obrigatório.',
            'cliente_id.exists' => 'O cliente selecionado não existe.',
            'valor_venda.required' => 'O valor da venda é obrigatório.',
            'valor_venda.min' => 'O valor da venda deve ser maior ou igual a 0.',
            'entrada.required' => 'O valor da entrada é obrigatório.',
            'entrada.min' => 'O valor da entrada deve ser maior ou igual a 0.',
            'entrada.lte' => 'O valor da entrada deve ser menor ou igual ao valor da venda.',
            'valor_financiado.required' => 'O valor financiado é obrigatório.',
            'valor_financiado.min' => 'O valor financiado deve ser maior ou igual a 0.',
            'metodo_pagamento_id.required' => 'O método de pagamento é obrigatório.',
            'metodo_pagamento_id.exists' => 'O método de pagamento selecionado não existe.',
            'data_venda.required' => 'A data da venda é obrigatória.',
            'data_venda.date' => 'A data da venda deve ser uma data válida.',
            'data_venda.before_or_equal' => 'A data da venda não pode ser futura.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'veiculo_id' => 'veículo',
            'cliente_id' => 'cliente',
            'valor_venda' => 'valor da venda',
            'entrada' => 'entrada',
            'valor_financiado' => 'valor financiado',
            'metodo_pagamento_id' => 'método de pagamento',
            'data_venda' => 'data da venda',
            'observacoes' => 'observações',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $valorVenda = $this->input('valor_venda');
            $entrada = $this->input('entrada');
            $valorFinanciado = $this->input('valor_financiado');

            // Validar se entrada + financiado = valor da venda
            if ($valorVenda && $entrada && $valorFinanciado) {
                $total = $entrada + $valorFinanciado;
                if (abs($total - $valorVenda) > 0.01) { // Tolerância para diferenças de centavos
                    $validator->errors()->add(
                        'valor_financiado',
                        'A soma da entrada e do valor financiado deve ser igual ao valor da venda.'
                    );
                }
            }
        });
    }
}