<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusVeiculo extends Model
{
    protected $table = 'status_veiculos';

    protected $fillable = [
        'nome',
        'cor',
        'icone',
        'descricao',
        'ativo',
        'ordem'
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'ordem' => 'integer',
    ];

    // Relacionamentos
    public function veiculos(): HasMany
    {
        return $this->hasMany(Veiculo::class, 'status_id');
    }

    // Scopes
    public function scopeAtivos($query)
    {
        return $query->where('ativo', true);
    }

    public function scopeOrdenados($query)
    {
        return $query->orderBy('ordem')->orderBy('nome');
    }

    // Acessors
    public function getNomeFormatadoAttribute()
    {
        return ucfirst($this->nome);
    }

    public function getCorFormatadaAttribute()
    {
        return $this->cor ?: '#6c757d';
    }
}
