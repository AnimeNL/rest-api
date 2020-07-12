<?php

namespace App\Converter;

class RoleToGroupConverter
{
    public function convert(string $role): string
    {
        if ($role === 'ROLE_USER') {
            return 'read';
        }

        return strtolower(str_replace(['ROLE_', '_'], ['', '.'], $role));
    }
}
