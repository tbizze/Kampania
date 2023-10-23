<?php

namespace App\Traits\RequestSanitizers;

use App\Traits\Contracts\RequestSanitizerContract;

/**
 * Torna maiúsculo o primeiro caractere das palavras de um $input.
 *
 * Class CapitalizeEachWords
 *
 * @package Mawuekom\RequestSanitizer\Sanitizers
 */
class CapitalizeEachWords implements RequestSanitizerContract
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
            return ucwords($input);
        }
    }
}