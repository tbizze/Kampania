<?php

namespace App\Traits\RequestSanitizers;

use App\Traits\Contracts\RequestSanitizerContract;

/**
 * Recebe um $input 'null' devolvendo como 'false'.
 *
 * Class NullToFalse
 *
 * @package Mawuekom\RequestSanitizer\Sanitizers
 */
class NullToFalse implements RequestSanitizerContract
{
    /**
     * Modifica um $input e devolva-o.
     *
     * @param  $input
     * @return string
     */
    public function sanitize($input)
    {
        if (!$input) {
            $input = false;
        }
        return $input;
    }
}