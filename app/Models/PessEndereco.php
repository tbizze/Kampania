<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PessEndereco extends Model
{
    use HasFactory;

    /**
     * Habilita o recurso de Apagar para Lixeira.
     */
    use SoftDeletes;

    /**
     * Lista des campos em que é permitido a persistência no BD.. 
     */
    protected $fillable = [
        'logradouro', 'numero', 'bairro', 'complemento', 'cep', 'cidade', 'uf', 'pessoa_id', //'notas',
    ];

    /**
     * O Endereço 'pertence a uma' Pessoa. 
     * Obtenha esse registro.
     */
    public function toPessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id')->withDefault(['nome' => 'N/D']);
    }
}
