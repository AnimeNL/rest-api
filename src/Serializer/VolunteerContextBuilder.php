<?php

namespace App\Serializer;

use ApiPlatform\Core\Serializer\SerializerContextBuilderInterface;
use App\Converter\RoleToGroupConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

final class VolunteerContextBuilder implements SerializerContextBuilderInterface
{
    public const TIMELINE_OPERATION = 'timeline_get';

    private SerializerContextBuilderInterface $decorated;
    private Security $security;
    private RoleToGroupConverter $roleToGroupConverter;

    public function __construct(
        SerializerContextBuilderInterface $decorated,
        Security $security,
        RoleToGroupConverter $roleToGroupConverter
    ) {
        $this->decorated = $decorated;
        $this->security = $security;
        $this->roleToGroupConverter = $roleToGroupConverter;
    }

    public function createFromRequest(Request $request, bool $normalization, ?array $extractedAttributes = null): array
    {
        $context = $this->decorated->createFromRequest($request, $normalization, $extractedAttributes);

        // The timeline operations expose a fixed, minimal set of fields regardless of the user's roles
        if ($this->isTimelineOperation($context)) {
            return $context;
        }

        $user = $this->security->getUser();

        if (!$user instanceof UserInterface) {
            return $context;
        }

        $context['groups'] = array_map([$this->roleToGroupConverter, 'convert'], $user->getRoles());

        return $context;
    }

    private function isTimelineOperation(array $context): bool
    {
        $operationName = $context['collection_operation_name'] ?? $context['item_operation_name'] ?? null;

        return $operationName === self::TIMELINE_OPERATION;
    }
}
