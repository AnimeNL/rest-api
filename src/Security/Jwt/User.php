<?php

namespace App\Security\Jwt;

use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUser;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;

final class User extends JWTUser
{
    public static function createFromPayload($username, array $payload): JWTUserInterface
    {
        $roles = array_map([RoleConverter::class, 'convert'], $payload['scopes']);

        return new self(
            $username,
            [...$roles, 'ROLE_USER']
        );
    }
}
