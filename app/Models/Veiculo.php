<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Veiculo extends Model
{
    protected $fillable = [
        'marca',
        'modelo',
        'versao',
        'ano_fab',
        'ano_modelo',
        'km',
        'cor',
        'chassi',
        'placa',
        'preco_compra',
        'preco_venda',
        'status_id',
        'observacoes',
        'foto_principal'
    ];

    protected $casts = [
        'preco_compra' => 'decimal:2',
        'preco_venda' => 'decimal:2',
        'ano_fab' => 'integer',
        'ano_modelo' => 'integer',
        'km' => 'integer',
    ];

    // Relacionamentos
    public function status(): BelongsTo
    {
        return $this->belongsTo(StatusVeiculo::class, 'status_id');
    }

    public function fotos(): HasMany
    {
        return $this->hasMany(VeiculoFoto::class);
    }

    public function vendas(): HasMany
    {
        return $this->hasMany(Venda::class);
    }

    // Scopes
    public function scopeDisponiveis($query)
    {
        return $query->whereHas('status', function($q) {
            $q->where('codigo', 'disponivel');
        });
    }

    public function scopePorStatus($query, $statusCodigo)
    {
        return $query->whereHas('status', function($q) use ($statusCodigo) {
            $q->where('codigo', $statusCodigo);
        });
    }

    public function scopePorMarca($query, $marca)
    {
        return $query->where('marca', 'like', "%{$marca}%");
    }

    public function scopePorModelo($query, $modelo)
    {
        return $query->where('modelo', 'like', "%{$modelo}%");
    }

    // Acessors
    public function getStatusFormatadoAttribute()
    {
        return $this->status ? $this->status->nome_formatado : 'N/A';
    }

    public function getPrecoVendaFormatadoAttribute()
    {
        return 'R$ ' . number_format($this->preco_venda, 2, ',', '.');
    }

    public function getPrecoCompraFormatadoAttribute()
    {
        return 'R$ ' . number_format($this->preco_compra, 2, ',', '.');
    }

    public function getStatusCodigoAttribute()
    {
        return $this->status ? $this->status->codigo : null;
    }
}
