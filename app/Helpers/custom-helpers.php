<?php

if (! function_exists('money')) {
    /**
     * Format money
     *
     * @param string|float $number Number to format
     * @param string|bool $prefix [optional] Prefix to add before number (default: R$ )
     * @param int $decimals [optional] Number of decimals (default: 2)
     * @param string $decimalSeparator [optional] Decimal separator (default: ,)
     * @param string $thousandSeparator [optional] Thousand separator (default: .)
     *
     * @return string Formatted number
     */
    /* function money(
        float|string $number,
        string|bool $prefix = 'R$ ',
        int $decimals = 2,
        string $decimalSeparator = ',',
        string $thousandSeparator = '.'
    ): string {
        return Format::money($number, $prefix, $decimals, $decimalSeparator, $thousandSeparator);
    } */

    function fnMoney(
        string|float $number,
        string|bool $prefix = 'R$ ',
        int $decimals = 2,
        string $decimalSeparator = ',',
        string $thousandSeparator = '.'
    ): string {
        $number = number_format((float) $number, $decimals, $decimalSeparator, $thousandSeparator);
        if ($prefix) {
            $number = $prefix . $number;
        }
        return $number;
    }
}