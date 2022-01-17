<?php

namespace App\Helpers;

class RoleHelper {
    public static function getRole($id)
    {
        if ($id == 1) return 'Admin';
        else if ($id == 2) return 'Officer';
        else if ($id == 3) return 'Seller';
        else if ($id == 4) return 'Student';

        return 'No Role';
    }
}
