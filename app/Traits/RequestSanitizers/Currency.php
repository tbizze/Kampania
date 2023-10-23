<?php

namespace App\Traits\BizSanitizers;

use App\Traits\Contracts\RequestSanitizerContract;

/**
 * Removes any non numeric character
 *
 * Class RemoveNonNumeric
 *
 * @package Mawuekom\RequestSanitizer\Sanitizers
 */
class NumberToDb implements RequestSanitizerContract
{
    /**
     * Sanitize an input and return it.
     *
     * @param  $input
     * @return string
     */
    public function sanitize($input)
    {
        if ($input) {
            return money($input, false, 2, '.', false);
        }
    }
}
