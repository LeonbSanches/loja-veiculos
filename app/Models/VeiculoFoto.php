<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VeiculoFoto extends Model
{
    protected $fillable = [
        'veiculo_id',
        'foto',
        'descricao',
        'principal',
        'ordem'
    ];

    protected $casts = [
        'principal' => 'boolean',
        'ordem' => 'integer',
    ];

    // Relacionamentos
    public function veiculo(): BelongsTo
    {
        return $this->belongsTo(Veiculo::class);
    }

    // Acessors
    public function getUrlFotoAttribute()
    {
        return asset('storage/' . $this->foto);
    }

    public function getThumbnailUrlAttribute()
    {
        $path = pathinfo($this->foto, PATHINFO_DIRNAME);
        $filename = pathinfo($this->foto, PATHINFO_FILENAME);
        $extension = pathinfo($this->foto, PATHINFO_EXTENSION);
        
        return asset('storage/' . $path . '/' . $filename . '_thumb.' . $extension);
    }

    // Scopes
    public function scopePrincipais($query)
    {
        return $query->where('principal', true);
    }

    public function scopeOrdenadas($query)
    {
        return $query->orderBy('ordem')->orderBy('id');
    }
}
