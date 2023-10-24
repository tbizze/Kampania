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
        /* $search =  array('Da ', 'Das ', 'De ', 'Do ', 'Dos ', 'A ', 'As ', 'E ', 'O ', 'Os ', 'Em');
        $replace = array('da ', 'das ', 'de ', 'do ', 'dos ', 'a ', 'as ', 'e ', 'o ', 'os ', 'em'); */
        if ($input) {
            return capitalize_words($input);
            //return ucwords($input);
            //return str_replace($search, $replace, ucwords(strtolower($input)));
        }
    }
}