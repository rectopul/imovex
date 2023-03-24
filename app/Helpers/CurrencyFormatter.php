<?php 

namespace App\Helpers;

use NumberFormatter;

class CurrencyFormatter 
{
    static function toBrazilianReal($currency)
    {
        $numberFormatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);

        return $currency ? 
            $numberFormatter->formatCurrency(self::clearCurrency($currency), 'BRL') : 
            null;
    }

    static function clearCurrency($currency)
    {
        if($currency) {
            $currency = str_replace('$', '', $currency);
            $currency = str_replace(',', '', $currency);

            return floatval($currency);
        }

        return $currency;
    }

    static function clearBrazilianCurrency($currency)
    {
        if($currency) {
            $currency = str_replace('R$', '', $currency);
            $currency = str_replace('.', '', $currency);
            $currency = str_replace(',', '.', $currency);
            $currency = trim($currency);
            $currency = str_replace(' ', '', $currency);

            return floatval($currency);
        }

        return $currency;
    }
}