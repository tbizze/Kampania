<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestSanitizer;

class UpdatePessoaRequest extends FormRequest
{
    // Pacote para tratar inputs (Mawuekom\RequestSanitizer). 
    use RequestSanitizer;

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
            // Regras de validações de Pessoas.
            'codigo' => 'nullable|string|max:15',
            'nome' => 'required|string|min:3|max:130',
            'dt_nasc' => 'nullable|date',
            'dt_casamento' => 'nullable|date',
            'sexo' => 'required|string|in:M,F',
            'conjuge' => 'nullable|string|min:3|max:130',
            'profissao' => 'nullable|string|min:3|max:75',
            'pess_est_civil_id' => 'nullable|integer',
            'rg_ie' => 'nullable|string|min:5|max:14',
            'cpf_cnpj' => 'nullable|digits_between:11,14',
            'celular' => 'nullable|digits_between:10,11',
            'email' => 'nullable|email|max:255',
            'notas' => 'nullable|string|max:255',

            // Regras de validações de Endereços
            'logradouro' => 'nullable|string|min:3|max:130',
            'numero' => 'nullable|string|max:8',
            'complemento' => 'nullable|string|min:3|max:20',
            'bairro' => 'nullable|string|min:3|max:50',
            'cep' => 'nullable|digits:8',
            'cidade' => 'nullable|string|min:3|max:100',
            'uf' => 'nullable|string|size:2',
            'principal' => 'nullable|boolean',
            'notas' => 'nullable|string|min:3|max:255',
            'pessoa_id' => 'nullable|integer',
        ];
    }

    /**
     * Método para preparar os dados do request para a validação.
     */
    protected function prepareForValidation(): void
    {
        // Invoca função para sanitizar Inputs
        $this->sanitize();
    }

    /**
     * Propriedade protegida para definir quais atributos do request serão tratados antes da validação.
     * Usa o pacote 'Mawuekom\RequestSanitizer'. 
     */
    protected $sanitizers = [
        'dt_nasc' => ['DateToDb'],
        'dt_casamento' => ['DateToDb'],
        'celular' => ['RemoveNonNumeric'],
        'nome' => ['Capitalize'],
        'conjuge' => ['Capitalize'],

        'cep' => ['RemoveNonNumeric'],
        'uf' => ['Uppercase'],
    ];
}
