<?php

namespace App\Traits\RequestSanitizers;

use App\Traits\Contracts\RequestSanitizerContract;

/**
 * Torna maiúsculo o primeiro caractere de um $input.
 *
 * Class Capitalize
 *
 * @package Mawuekom\RequestSanitizer\Sanitizers
 */
class Capitalize implements RequestSanitizerContract
{
    /**
     * Modifica um $input e devolva-o.
     *
     * @param  $input
     * @return mixed
     */
    public function sanitize($input)
    {
        if ($input) {
            return ucfirst($input);
        }
    }
}
