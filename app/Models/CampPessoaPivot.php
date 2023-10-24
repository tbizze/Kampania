<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampPessoaPivot extends Model
{
    use HasFactory;

    protected $table = 'campanha_pessoa'; //especificando o nome da tabela
    protected $primaryKey = 'id';

    /**
     * Habilita o recurso de Apagar para Lixeira.
     */
    use SoftDeletes;

    /**
     * Lista des campos em que é permitido a persistência no BD.. 
     */
    protected $fillable = [
        'dt_adesao','dt_encerramento','valor','notif_email','notif_whatsapp','camp_sit_id','camp_gpo_id'
    ];

    /**
     * Configura o formato da data p/ as colunas 'dt_lcto'.
    */
    protected $casts = [
        'dt_adesao' => 'date:d/m/Y',
        'dt_encerramento' => 'date:d/m/Y',
    ];

    /**
     * Cria uma nova propriedade que é acrescentada às diretas do BD.
     * É passado em um array os nomes das propriedades desejadas.
    */
    protected $appends = [
        //'formatted_valor',
    ];

    /**
     * Altera o atributo do BD 
     * retorna novo valor mascarado com a função currency_get_db().
    */
    protected function valor(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => currency_get_db(!$value ? 0 : $value),
        );
    }

    /**
     * A Campanha 'pertence a uma' Pessoa. 
     * Obtenha esse registro.
     */
    public function toPessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class,'pessoa_id')->withDefault(['nome' => 'N/D']);
    }

    /**
     * A Campanha 'pertence a um' Grupo. 
     * Obtenha esse registro.
     */
    public function toGrupo(): BelongsTo
    {
        return $this->belongsTo(CampGpo::class,'camp_gpo_id')->withDefault(['nome' => 'N/D']);
    }

    /**
     * A Campanha 'pertence a uma' Situação. 
     * Obtenha esse registro.
     */
    public function toSituacao(): BelongsTo
    {
        return $this->belongsTo(CampSit::class,'camp_sit_id')->withDefault(['nome' => 'N/D']);
    }
}
