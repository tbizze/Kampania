<?php

namespace App\Traits\RequestSanitizers;

use Carbon\Carbon;
use App\Traits\Contracts\RequestSanitizerContract;
use Illuminate\Support\Str;

/**
 * Formata uma data brasileira (dd/mm/yyyy) para formato BD ('Y-m-d') de um $input.
 * Se receber sem dígitos do ano (dd/mm), assumirá ano corrente.
 *
 * Class DateToDb
 *
 * @package Mawuekom\RequestSanitizer\Sanitizers
 */
class DateToDb implements RequestSanitizerContract
{
    /**
     * Converte um $input e devolva-o.
     *
     * @param  $input
     * @return string
     */
    public function sanitize($input)
    {
        if ($input) {
            // Remonta a data formato Y-mm-d.
            return date_to_db($input);
        }
    }
}