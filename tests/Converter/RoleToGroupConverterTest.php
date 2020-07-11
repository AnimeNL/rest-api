<?php

namespace App\Tests\Converter;

use App\Converter\RoleToGroupConverter;
use PHPUnit\Framework\TestCase;

class RoleToGroupConverterTest extends TestCase
{

    private RoleToGroupConverter $converter;

    public function converterProvider(): array
    {
        return [
            ['ROLE_CMS', 'cms'],
            ['CMS', 'cms'],
            ['ROLE_EVENTS_CREATE', 'events.create'],
            ['ROLE_USER', 'read'],
            ['events.read', 'events.read'],
        ];
    }

    /**
     * @dataProvider converterProvider
     */
    public function testConvert(string $input, string $output)
    {
        self::assertEquals($output, $this->converter->convert($input));
    }

    public function setUp(): void
    {
        $this->converter = new RoleToGroupConverter();
    }
}
