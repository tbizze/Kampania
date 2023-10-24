<?php

namespace App\Traits\RequestSanitizers;

use App\Traits\Contracts\RequestSanitizerContract;

/**
 * Simple PHP filter_var sanitizer
 *
 * Class Capitalize
 *
 * @package Mawuekom\RequestSanitizer\Sanitizers
 */
class FilterVars implements RequestSanitizerContract
{
    private $filter;
    private $options;

    /**
     * Create new instance
     * 
     * @return void
     */
    public function __construct(int $filter = FILTER_DEFAULT, $options = null)
    {
        $this ->filter = $filter;
        $this ->options = $options;
    }

    /**
     * Sanitize an input and return it.
     *
     * @param  $input
     * @return string
     */
    public function sanitize($input)
    {
        return filter_var($input, $this ->filter, $this ->options);
    }
}