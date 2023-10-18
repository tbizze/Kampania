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
        'dt_adesao', 'dt_encerramento', 'valor', 'notif_email', 'notif_whatsapp', 'camp_sit_id', 'camp_gpo_id'
    ];

    /**
     * Configura o formato da data p/ as colunas 'dt_lcto'.
     */
    protected $casts = [
        'dt_adesao' => 'date:d/m/Y',
        'dt_encerramento' => 'date:d/m/Y',
    ];

    protected $appends = [
        //'formatted_valor',
    ];

    protected function valor(): Attribute
    {
        return Attribute::make(
            // A função money pede um valor numérico. Para evitar erro, se for null então passa 0.
            get: fn ($value) => money($value ? $value : 0, false, 2, ',', false),
            //get: fn () => money($this->valor ? $this->valor : 0, false, 2, ',', false),
        );
    }

    /**
     * A Campanha 'pertence a uma' Pessoa. 
     * Obtenha esse registro.
     */
    public function toPessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id')->withDefault(['nome' => 'N/D']);
    }

    /**
     * A Campanha 'pertence a um' Grupo. 
     * Obtenha esse registro.
     */
    public function toGrupo(): BelongsTo
    {
        return $this->belongsTo(CampGpo::class, 'camp_gpo_id')->withDefault(['nome' => 'N/D']);
    }

    /**
     * A Pessoa 'pertence a uma' Situação. 
     * Obtenha esse registro.
     */
    public function toSituacao(): BelongsTo
    {
        return $this->belongsTo(CampSit::class, 'camp_sit_id')->withDefault(['nome' => 'N/D']);
    }
}
