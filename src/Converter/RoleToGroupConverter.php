<?php

namespace App\Converter;

class RoleToGroupConverter
{
    public function convert(string $role): string
    {
        if ('ROLE_USER' === $role) {
            return 'read';
        }

        return strtolower(str_replace(['ROLE_', '_'], ['', '.'], $role));
    }
}
