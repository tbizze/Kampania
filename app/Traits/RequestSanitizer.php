<?php

namespace App\Traits;

use Illuminate\Support\Arr;
use InvalidArgumentException;
use App\Traits\Contracts\RequestSanitizerContract;

/**
 * Input sanitizer trait
 *
 * Trait InputSanitizer
 *
 * @package Mawuekom\RequestSanitizer\Traits
 */
trait RequestSanitizer
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->sanitize();
    }

    public function sanitize()
    {
        $input = $this->all();

        //dd($input);

        foreach ($this->getSanitizers() as $form_input => $sanitizers) {
            if (!$this->has($form_input)) {
                // Caso a requisição não possua uma propriedade para esta chave, não há necessidade de higienizar nada.
                continue;
            }

            $sanitizers = (array) $sanitizers;

            foreach ($sanitizers as $key => $value) {
                // Faz equivalência do valor definido no FormRequest com caminho da classe a sanitizar.
                switch ($value) {
                    case 'DateToDb':
                        $value = \App\Traits\RequestSanitizers\DateToDb::class;
                        break;
                    case 'NullToFalse':
                        $value = \App\Traits\RequestSanitizers\NullToFalse::class;
                        break;
                    case 'CurrencyToDb':
                        $value = \App\Traits\RequestSanitizers\CurrencyToDb::class;
                        break;
                    case 'RemoveNonNumeric':
                        $value = \App\Traits\RequestSanitizers\RemoveNonNumeric::class;
                        break;
                    case 'Capitalize':
                        $value = \App\Traits\RequestSanitizers\Capitalize::class;
                        break;
                    case 'CapitalizeEachWords':
                        $value = \App\Traits\RequestSanitizers\CapitalizeEachWords::class;
                        break;
                    case 'Lowercase':
                        $value = \App\Traits\RequestSanitizers\Lowercase::class;
                        break;
                    case 'Uppercase':
                        $value = \App\Traits\RequestSanitizers\Uppercase::class;
                        break;
                }

                if (is_string($key)) {
                    $sanitizer = app()->make($key, $value);
                } elseif (is_string($value)) {
                    $sanitizer = app()->make($value);
                } elseif ($value instanceof RequestSanitizerContract) {
                    $sanitizer = $value;
                } else {
                    throw new InvalidArgumentException('Não foi possível resolver o \'sanitizer\' de determinadas propriedades');
                }

                //dd(Arr::set($input, $form_input, $sanitizer->sanitize($this->input($form_input, null))));

                // Remonta como array o $input. Cada chave passada no FormRequest.
                // $sanitizer->sanitize, isto invoca a classe informada no FormRequest para essa coluna da tabela do BD.
                Arr::set($input, $form_input, $sanitizer->sanitize($this->input($form_input, null)));

                $this->replace($input);
            }
        }

        //dd($input);

        return $this->replace($input);
    }

    public function getSanitizers($form_input = null)
    {
        if (!property_exists($this, 'sanitizers')) {
            $this->sanitizers = [];
        }

        if ($form_input !== null) {
            return $this->sanitizers[$form_input] ?? [];
        }

        return $this->sanitizers;
    }
}
