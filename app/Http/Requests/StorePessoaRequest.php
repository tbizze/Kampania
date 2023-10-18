<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
//use App\Traits\SanitizeInputs;
use Mawuekom\RequestSanitizer\Traits\InputSanitizer;

class StorePessoaRequest extends FormRequest
{
    // Pacote para tratar inputs (MMawuekom\RequestSanitizer). 
    use InputSanitizer; 

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TRUE: Autoriza a submissão do formulário.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // Regras de validações.
            'codigo' => 'nullable|string|max:15|min:3',
            'nome' => 'required|string|max:130|min:3',
            'dt_nasc' => 'nullable|date',
            'dt_casamento' => 'nullable|date',
            'sexo' => 'required|string|in:M,F',
            'conjuge' => 'nullable|string|max:130|min:3',
            'profissao' => 'nullable|string|max:75|min:3',
            'pess_est_civil_id' => 'nullable|integer',
            'rg_ie' => 'nullable|string|min:|min:5',
            'cpf_cnpj' => 'nullable|string|max:14|min:11',
            'celular' => 'nullable|max:11|min:10',
            'email' => 'nullable|email|max:255',
            'notas' => 'nullable|string|max:255',

            // Regras de validações de Endereços
            'logradouro' => 'nullable|string|max:130|min:3',
            'numero' => 'nullable|string|max:6',
            'complemento' => 'nullable|string|max:20',
            'bairro' => 'nullable|string|max:50|min:3',
            'cep' => 'nullable|string|digits:8',
            'cidade' => 'nullable|string|max:100',
            'uf' => 'nullable|string|max:2|min:2',
            'principal' => 'nullable|boolean',
            'notas' => 'nullable|string|max:255',
            'pessoa_id' => 'nullable|integer',

            // Regras de validações de Campanha
            'dt_adesao' => 'nullable|date',
            'dt_encerramento' => 'nullable|date',
            'camp_sit_id' => 'nullable|integer',
            'camp_gpo_id' => 'nullable|integer',
            'valor' => 'nullable|decimal:2',
            'notif_email' => 'nullable|boolean',
            'notif_whatsapp' => 'nullable|boolean',
        ];
    }

    /**
     * Método para preparar os dados do request para a validação.
     */
    protected function prepareForValidation(): void
    {
        // Invoca função para sanitizar Inputs
        $this ->sanitize();
    }
    
    /**
     * Propriedade protegida para definir quais atributos do request serão tratados antes da validação.
     * Usa o pacote 'Mawuekom\RequestSanitizer'. 
     */
    protected $sanitizers = [
        'dt_casamento' => [\Mawuekom\RequestSanitizer\Sanitizers\DateMask::class],
        'dt_nasc' => [\Mawuekom\RequestSanitizer\Sanitizers\DateMask::class],
        'dt_adesao' => [\Mawuekom\RequestSanitizer\Sanitizers\DateMask::class],
        'conjuge' => [\Mawuekom\RequestSanitizer\Sanitizers\CapitalizeEachWords::class],
        'uf' => [\Mawuekom\RequestSanitizer\Sanitizers\Uppercase::class],
        'logradouro' => [\Mawuekom\RequestSanitizer\Sanitizers\CapitalizeEachWords::class],
        'bairro' => [\Mawuekom\RequestSanitizer\Sanitizers\CapitalizeEachWords::class],
        'celular' => [\Mawuekom\RequestSanitizer\Sanitizers\RemoveNonNumeric::class],
        'cep' => [\Mawuekom\RequestSanitizer\Sanitizers\RemoveNonNumeric::class],
        'valor' => [\Mawuekom\RequestSanitizer\Sanitizers\CurrencyMask::class],
        'notif_email' => [\Mawuekom\RequestSanitizer\Sanitizers\SanitBoolFalse::class],
        'notif_whatsapp' => [\Mawuekom\RequestSanitizer\Sanitizers\SanitBoolFalse::class],
     ];   
}
