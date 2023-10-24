<?php

namespace App\Traits\RequestSanitizers;

use App\Traits\Contracts\RequestSanitizerContract;

/**
 * Simple PHP trim() implementation
 *
 * Class Trim
 *
 * @package Mawuekom\RequestSanitizer\Sanitizers
 */
class Trim implements RequestSanitizerContract
{
    /**
     * Sanitize an input and return it.
     *
     * @param  $input
     * @return mixed
     */
    public function sanitize($input)
    {
        return trim($input);
    }
}