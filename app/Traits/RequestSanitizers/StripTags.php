<?php

namespace App\Traits\RequestSanitizers;

use App\Traits\Contracts\RequestSanitizerContract;

/**
 * Strip tags from the given string.
 *
 * Class StrigTags
 *
 * @package Mawuekom\RequestSanitizer\Sanitizers
 */
class StripTags implements RequestSanitizerContract
{
    /**
     * Sanitize an input and return it.
     *
     * @param  $input
     * @return string
     */
    public function sanitize($input)
    {
        return is_string($input) ? strip_tags($input) : $input;
    }
}