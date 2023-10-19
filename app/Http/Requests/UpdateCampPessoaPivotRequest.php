<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Mawuekom\RequestSanitizer\Traits\InputSanitizer;

class UpdateCampPessoaPivotRequest extends FormRequest
{
    // Pacote para tratar inputs (Mawuekom\RequestSanitizer). 
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

        /* if (!$this->notif_email) {
            $this->merge([
                'notif_email' => false,
            ]);
        }
        if (!$this->notif_whatsapp) {
            $this->merge([
                'notif_whatsapp' => false,
            ]);
        }
        if ($this->dt_adesao) {
            $data = Str::of($this->dt_adesao)->explode('/');
            if(count($data) == 3){
                $new_data = Str::padLeft($data[2],2,'0')  . '-' . Str::padLeft($data[1],2,'0') . '-' . Str::padLeft($data[0],2,'0');
                $this->merge([
                    'dt_adesao' => $new_data,
                ]);
            }
        }

        if ($this->dt_encerramento) {
            $data = Str::of($this->dt_encerramento)->explode('/');
            if(count($data) == 3){
                $new_data = Str::padLeft($data[2],2,'0')  . '-' . Str::padLeft($data[1],2,'0') . '-' . Str::padLeft($data[0],2,'0');
                $this->merge([
                    'dt_encerramento' => $new_data,
                ]);
            }
        } */
    }

    /**
     * Propriedade protegida para definir quais atributos do request serão tratados antes da validação.
     * Usa o pacote 'Mawuekom\RequestSanitizer'. 
     */
    protected $sanitizers = [
        'dt_encerramento' => [\Mawuekom\RequestSanitizer\Sanitizers\DateMask::class],
        'dt_adesao' => [\Mawuekom\RequestSanitizer\Sanitizers\DateMask::class],
        'notif_email' => [\Mawuekom\RequestSanitizer\Sanitizers\SanitBoolFalse::class],
        //'notif_whatsapp' => [\Mawuekom\RequestSanitizer\Sanitizers\SanitBoolFalse::class],
        'valor' => [\Mawuekom\RequestSanitizer\Sanitizers\CurrencyMask::class],
     ];  
}
