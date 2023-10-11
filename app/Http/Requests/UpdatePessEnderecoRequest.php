<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePessEnderecoRequest extends FormRequest
{
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
            'logradouro' => 'nullable|string|max:130',
            'numero' => 'nullable|string|max:6',
            'complemento' => 'nullable|string|max:20',
            'bairro' => 'nullable|string|max:50',
            'cep' => 'nullable|string|max:8|min:8',
            'cidade' => 'nullable|string|max:100',
            'uf' => 'nullable|string|max:2',
            'principal' => 'nullable|boolean',
            'notas' => 'nullable|string|max:255',

            'pessoa_id' => 'nullable|integer',
        ];
    }
}
