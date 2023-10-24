<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestSanitizer;

class UpdateCampPessoaPivotRequest extends FormRequest
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
            'dt_adesao' => 'nullable|date',
            'dt_encerramento' => 'nullable|date',
            'camp_sit_id' => 'nullable|integer',
            'camp_gpo_id' => 'nullable|integer',
            'valor' => 'nullable|numeric',
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
        $this->sanitize();
    }

    /**
     * Propriedade protegida para definir quais atributos do request serão tratados antes da validação.
     * Usa o pacote 'Mawuekom\RequestSanitizer'. 
     */
    protected $sanitizers = [
        'dt_adesao' => ['DateToDb'],
        'dt_encerramento' => ['DateToDb'],
        'notif_email' => ['NullToFalse'],
        'notif_whatsapp' => ['NullToFalse'],
        'valor' => ['CurrencyToDb'], 
    ];
}
