<?php

namespace App\Helpers;

class CurrencyHelper {
    public static function rupiah($number)
    {
        return 'Rp' . number_format($number, 0, ',', '.');
    }
}
