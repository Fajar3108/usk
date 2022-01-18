<?php

namespace App\Helpers;

class TransactionHelper {
    public static function type($id)
    {
        if ($id == 1) return 'Top Up';
        else if ($id == 2) return 'Purchase';
        else if ($id == 3) return 'Withdraw';

        return 'Undefined';
    }

    public static function status($id)
    {
        if ($id == 0) return 'Pending';
        else if ($id == 1) return 'Success';
        else if ($id == 2) return 'Failed';

        return 'Undefined';
    }
}
