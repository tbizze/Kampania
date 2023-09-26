<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PessGpo extends Model
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
     * As Pessoas que 'pertencem a vários' Grupos. 
     * Obtenha esse registro.
     */
    public function grupos(): BelongsToMany
    {
        return $this->belongsToMany(Pessoa::class,'pessoa_grupo');
    }
}
