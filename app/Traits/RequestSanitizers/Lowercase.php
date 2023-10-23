<?php

namespace App\Traits\RequestSanitizers;

use App\Traits\Contracts\RequestSanitizerContract;

/**
 * Torna um $input inteiro em minúsculo.
 *
 * Class Lowercase
 *
 * @package Mawuekom\RequestSanitizer\Sanitizers
 */
class Lowercase implements RequestSanitizerContract
{
    /**
     * Modifica um $input e devolva-o.
     *
     * @param  $input
     * @return string
     */
    public function sanitize($input)
    {
        if ($input) {
            return strtolower($input);
        }
    }
}