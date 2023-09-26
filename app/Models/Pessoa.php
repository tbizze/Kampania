<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
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
        'nome', 'email','notas','sexo','pess_est_civil_id','codigo','dt_nasc','celular','dt_casamento','conjuge','profissao','rg_ie','cpf_cnpj'
    ];

    /**
     * Configura o formato da data p/ as colunas 'dt_lcto'.
    */
    protected $casts = [
        'dt_nasc' => 'date:d/m/Y',
        'dt_casamento' => 'date:d/m/Y',
        'dt_adesao' => 'date:d/m/Y',
    ];

    /**
     * A Pessoa 'pertence a um' Estado Civil. 
     * Obtenha esse registro.
     */
    public function toEstCivil(): BelongsTo
    {
        return $this->belongsTo(PessEstCivil::class,'pess_est_civil_id')->withDefault(['nome' => 'N/D']);
    }
    
    /**
     * Os Grupos que 'pertencem a várias' Pessoas. 
     * Obtenha esses registros.
     */
    public function grupos(): BelongsToMany
    {
        return $this->belongsToMany(PessGpo::class,'pessoa_grupo')
            ->withTimestamps();
    }

    /**
     * As Campanhas que 'pertencem a várias' Pessoas. 
     * Obtenha esses registros.
     */
    public function campanhaItens(): BelongsToMany
    {
        return $this->belongsToMany(CampPessoaPivot::class,'campanha_pessoa','pessoa_id','campanha_id')
        ->withPivot('dt_adesao','notif_email','notif_whatsapp')    
        ->withTimestamps();
    }
}