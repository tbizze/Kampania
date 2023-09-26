<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StorePessoaRequest extends FormRequest
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
            // Regras de validações.
            'codigo' => 'nullable|string|max:15',
            'nome' => 'required|string|max:130',
            'dt_nasc' => 'nullable|date',
            'dt_casamento' => 'nullable|date',
            'sexo' => 'required|string|in:M,F',
            'conjuge' => 'nullable|string|max:130',
            'profissao' => 'nullable|string|max:75',
            'pess_est_civil_id' => 'nullable|integer',
            'rg_ie' => 'nullable|string',
            'cpf_cnpj' => 'nullable|string|max:14',
            'celular' => 'nullable|digits:11',
            'email' => 'nullable|email|max:255',
            'notas' => 'nullable|string|max:255',
            
            'dt_adesao' => 'nullable|date',
            'dt_encerramento' => 'nullable|date',
            'camp_sit_id' => 'nullable|integer',
            'camp_gpo_id' => 'nullable|integer',
            'valor' => 'nullable|decimal:2',
            'notif_email' => 'nullable|boolean',
            'notif_whatsapp' => 'nullable|boolean',
        ];
    }
    protected function prepareForValidation(): void
    {
        if (!$this->notif_email) {
            $this->merge([
                'notif_email' => false,
            ]);
        }
        if (!$this->notif_whatsapp) {
            $this->merge([
                'notif_whatsapp' => false,
            ]);
        }

        if ($this->dt_nasc) {
            $data = Str::of($this->dt_nasc)->explode('/');
            if(count($data) == 3){
                $new_data = Str::padLeft($data[2],2,'0')  . '-' . Str::padLeft($data[1],2,'0') . '-' . Str::padLeft($data[0],2,'0');
                $this->merge([
                    'dt_nasc' => $new_data,
                ]);
            }
        }

        if ($this->dt_casamento) {
            $data = Str::of($this->dt_casamento)->explode('/');
            if(count($data) == 3){
                $new_data = Str::padLeft($data[2],2,'0')  . '-' . Str::padLeft($data[1],2,'0') . '-' . Str::padLeft($data[0],2,'0');
                $this->merge([
                    'dt_casamento' => $new_data,
                ]);
            }
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
        }
    }
}
