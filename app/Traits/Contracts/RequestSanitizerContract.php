<?php

namespace App\Traits\Contracts;

/**
 * Request sanitizer contract
 *
 * Class DataManagerRepo
 *
 * @package Mawuekom\RequestSanitizer\Contracts
 */
interface RequestSanitizerContract
{
    /**
     * Sanitize an input and return it.
     *
     * @param $input
     * @return mixed
     */
    public function sanitize($input);
}