<?php

namespace App\Security\Jwt;

use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUser;

final class User extends JWTUser
{
    public static function createFromPayload($username, array $payload)
    {
        $roles = array_map([RoleConverter::class, 'convert'], $payload['scopes']);

        return new self(
            $username,
            [...$roles, 'ROLE_USER']
        );
    }
}
