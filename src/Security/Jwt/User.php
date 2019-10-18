<?php

namespace App\Security\Jwt;

use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUser;

final class User extends JWTUser
{
    public static function createFromPayload($username, array $payload)
    {
        $roles = array_map(
            static function ($role) {
                $role = strtoupper($role);
                $role = str_replace(' ', '_', $role);

                return 'ROLE_'.$role;
            },
            $payload['scopes']
        );

        return new self(
            $username,
            array_merge($roles, ['ROLE_USER'])
        );
    }
}
