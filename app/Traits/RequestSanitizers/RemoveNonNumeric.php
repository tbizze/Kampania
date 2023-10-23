<?php

namespace App\Traits\RequestSanitizers;

use App\Traits\Contracts\RequestSanitizerContract;

/**
 * Remove qualquer caractere não numérico
 *
 * Class RemoveNonNumeric
 *
 * @package Mawuekom\RequestSanitizer\Sanitizers
 */
class RemoveNonNumeric implements RequestSanitizerContract
{
    /**
     * Sanitize um $input e devolva-o.
     *
     * @param  $input
     * @return string
     */
    public function sanitize($input)
    {
        if ($input) {
            return preg_replace('~[^0-9]+~', '', $input);
        }
    }
}