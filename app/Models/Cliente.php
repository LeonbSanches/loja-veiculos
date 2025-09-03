<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cliente extends Model
{
    protected $fillable = [
        'tipo_cliente_id',
        'nome',
        'email',
        'telefone',
        'celular',
        'cpf',
        'rg',
        'data_nascimento',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'observacoes'
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    // Relacionamentos
    public function tipoCliente(): BelongsTo
    {
        return $this->belongsTo(TipoCliente::class, 'tipo_cliente_id');
    }

    public function vendas(): HasMany
    {
        return $this->hasMany(Venda::class);
    }

    // Acessors
    public function getNomeFormatadoAttribute()
    {
        return ucwords(strtolower($this->nome));
    }

    public function getCpfFormatadoAttribute()
    {
        if (!$this->cpf) return null;
        $cpf = preg_replace('/[^0-9]/', '', $this->cpf);
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }

    public function getCepFormatadoAttribute()
    {
        if (!$this->cep) return null;
        $cep = preg_replace('/[^0-9]/', '', $this->cep);
        return substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
    }

    public function getTelefoneFormatadoAttribute()
    {
        $telefone = preg_replace('/[^0-9]/', '', $this->telefone);
        if (strlen($telefone) === 11) {
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7);
        } else {
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6);
        }
    }

    // Scopes
    public function scopePessoaFisica($query)
    {
        return $query->whereHas('tipoCliente', function($q) {
            $q->where('codigo', 'PF');
        });
    }

    public function scopePessoaJuridica($query)
    {
        return $query->whereHas('tipoCliente', function($q) {
            $q->where('codigo', 'PJ');
        });
    }

    public function scopePorNome($query, $nome)
    {
        return $query->where('nome', 'like', "%{$nome}%");
    }
}
