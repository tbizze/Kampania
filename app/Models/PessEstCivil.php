<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PessEstCivil extends Model
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
        'nome', 'notas'
    ];

    /**
     * O Estado Civil 'tem muitas' (hasMany) Pessoas.
     * Obtenha essa coleção de registros.
     */
    public function hasPessoas(): HasMany
    {
        return $this->hasMany(Pessoa::class);
    }
}
