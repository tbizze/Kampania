<?php

namespace App\Traits\RequestSanitizers;

use App\Traits\Contracts\RequestSanitizerContract;

/**
 * Torna um $input inteiro em maiúsculo.
 *
 * Class Uppercase
 *
 * @package Mawuekom\RequestSanitizer\Sanitizers
 */
class Uppercase implements RequestSanitizerContract
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
            return strtoupper($input);
        }
    }
}