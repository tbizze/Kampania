<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contribuicao extends Model
{
    use HasFactory;

    protected $table = 'contribuicoes'; //especificando o nome da tabela

    /**
     * Habilita o recurso de Apagar para Lixeira.
     */
    use SoftDeletes;

    /**
     * Lista des campos em que é permitido a persistência no BD.. 
     */
    protected $fillable = [
        'valor','periodo','val_operacao','dt_operacao','conta_id','operacao_tp_id','campanha_pessoa_id',
    ];

    /**
     * Configura o formato da data p/ as colunas 'dt_lcto'.
    */
    protected $casts = [
        'dt_operacao' => 'date:d/m/Y',
    ];

    /**
     * A Contribuição 'pertence a uma' Conta. 
     * Obtenha esse registro.
     */
    public function toConta(): BelongsTo
    {
        return $this->belongsTo(Conta::class,'conta_id')->withDefault(['nome' => 'N/D']);
    }

    /**
     * A Contribuição 'pertence a uma' Conta. 
     * Obtenha esse registro.
     */
    public function toOperacaoTp(): BelongsTo
    {
        return $this->belongsTo(OperacaoTp::class,'operacao_tp_id')->withDefault(['nome' => 'N/D']);
    }

    

}
