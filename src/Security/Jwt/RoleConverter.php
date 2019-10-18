<?php

namespace App\Security\Jwt;

class RoleConverter
{
    public static function convert(string $role):string
    {
        $converted = strtoupper($role);
        $converted = str_replace([' ', '.'], '_', $converted);

        return 'ROLE_'.$converted;
    }
}
