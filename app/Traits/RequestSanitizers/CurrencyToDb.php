<?php

namespace App\Traits\RequestSanitizers;

use App\Traits\Contracts\RequestSanitizerContract;

/**
 * Converte um $input monetário para formato decimal do BD.
 *
 * Class RemoveNonNumeric
 *
 * @package Mawuekom\RequestSanitizer\Sanitizers
 */
class CurrencyToDb implements RequestSanitizerContract
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
            return currency_to_db($input);
        }
    }
}
