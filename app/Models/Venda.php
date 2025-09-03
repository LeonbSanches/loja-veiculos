<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Venda extends Model
{
    protected $fillable = [
        'veiculo_id',
        'cliente_id',
        'user_id',
        'valor_venda',
        'entrada',
        'valor_financiado',
        'metodo_pagamento_id',
        'data_venda',
        'observacoes'
    ];

    protected $casts = [
        'valor_venda' => 'decimal:2',
        'entrada' => 'decimal:2',
        'valor_financiado' => 'decimal:2',
        'data_venda' => 'date',
    ];

    // Relacionamentos
    public function veiculo(): BelongsTo
    {
        return $this->belongsTo(Veiculo::class);
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function metodoPagamento(): BelongsTo
    {
        return $this->belongsTo(MetodoPagamento::class, 'metodo_pagamento_id');
    }

    // Acessors
    public function getValorVendaFormatadoAttribute()
    {
        return 'R$ ' . number_format($this->valor_venda, 2, ',', '.');
    }

    public function getEntradaFormatadaAttribute()
    {
        return 'R$ ' . number_format($this->entrada, 2, ',', '.');
    }

    public function getValorFinanciadoFormatadoAttribute()
    {
        return 'R$ ' . number_format($this->valor_financiado, 2, ',', '.');
    }

    public function getMetodoPagamentoFormatadoAttribute()
    {
        return $this->metodoPagamento ? $this->metodoPagamento->nome_formatado : 'N/A';
    }

    public function getDataVendaFormatadaAttribute()
    {
        return $this->data_venda->format('d/m/Y');
    }

    // Scopes
    public function scopePorMes($query, $mes, $ano = null)
    {
        $ano = $ano ?? now()->year;
        return $query->whereYear('data_venda', $ano)
                    ->whereMonth('data_venda', $mes);
    }

    public function scopePorVendedor($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
