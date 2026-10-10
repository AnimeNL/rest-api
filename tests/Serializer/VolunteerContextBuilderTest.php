<?php

namespace App\Tests\Serializer;

use ApiPlatform\Core\Serializer\SerializerContextBuilderInterface;
use App\Converter\RoleToGroupConverter;
use App\Serializer\VolunteerContextBuilder;
use App\Security\Jwt\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class VolunteerContextBuilderTest extends TestCase
{
    public function testRoleGroupsReplaceDefaultGroups()
    {
        $builder = $this->createBuilder(['collection_operation_name' => 'get', 'groups' => ['read', 'events.read']]);

        $context = $builder->createFromRequest(new Request(), true);

        self::assertEquals(['read'], $context['groups']);
    }

    public function operationProvider(): array
    {
        return [
            ['collection_operation_name'],
            ['item_operation_name'],
        ];
    }

    /**
     * @dataProvider operationProvider
     */
    public function testTimelineOperationKeepsTimelineGroup(string $operationKey)
    {
        $builder = $this->createBuilder([
            $operationKey => VolunteerContextBuilder::TIMELINE_OPERATION,
            'groups' => ['timeline'],
        ]);

        $context = $builder->createFromRequest(new Request(), true);

        self::assertEquals(['timeline'], $context['groups']);
    }

    private function createBuilder(array $decoratedContext): VolunteerContextBuilder
    {
        $decorated = $this->createMock(SerializerContextBuilderInterface::class);
        $decorated->method('createFromRequest')->willReturn($decoratedContext);

        $user = new User('volunteer', ['ROLE_USER']);

        $security = $this->createMock(Security::class);
        $security->method('getUser')->willReturn($user);

        return new VolunteerContextBuilder($decorated, $security, new RoleToGroupConverter());
    }
}
