<?php

namespace App\Tests;

use App\Security\Jwt\RoleConverter;
use PHPUnit\Framework\TestCase;

class RoleConverterTest extends TestCase
{
    public function roleProvider()
    {
        return [
            ['Test one', 'ROLE_TEST_ONE'],
            ['TestONE', 'ROLE_TESTONE'],
            ['Test.one', 'ROLE_TEST_ONE'],
        ];
    }

    /**
     * @param string $role
     * @param string $expected
     * @dataProvider roleProvider
     */
    public function testConvert(string $role, string $expected)
    {
        self::assertEquals($expected, RoleConverter::convert($role));
    }
}
