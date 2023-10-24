<?php

namespace App\Traits\RequestSanitizers;

use App\Traits\Contracts\RequestSanitizerContract;

/**
 * Replaces duplicate spaces with a single space.
 *
 * Class TrimDuplicateSpaces
 *
 * @package Mawuekom\RequestSanitizer\Sanitizers
 */
class TrimDuplicateSpaces implements RequestSanitizerContract
{
    /**
     * Sanitize an input and return it.
     *
     * @param  $input
     * @return mixed
     */
    public function sanitize($input)
    {
        return preg_replace('~\s{2,}~', ' ', $input);
    }
}