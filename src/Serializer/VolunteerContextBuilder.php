<?php

namespace App\Serializer;

use ApiPlatform\Core\Serializer\SerializerContextBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

final class VolunteerContextBuilder implements SerializerContextBuilderInterface
{
    private SerializerContextBuilderInterface $decorated;
    private AuthorizationCheckerInterface $authorizationChecker;

    public function __construct(
        SerializerContextBuilderInterface $decorated,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->decorated = $decorated;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function createFromRequest(Request $request, bool $normalization, ?array $extractedAttributes = null): array
    {
        $context = $this->decorated->createFromRequest($request, $normalization, $extractedAttributes);

        $roleToGroup = [
            'ROLE_TECH_CREW' => 'tech-crew',
            'ROLE_GOPHER' => 'gopher',
            'ROLE_SENIOR_GOPHER' => 'senior-gopher',
            'ROLE_GOPHER_MANAGER' => 'gopher-manager',
            'ROLE_STEWARD' => 'steward',
            'ROLE_SENIOR_STEWARD' => 'senior-steward',
            'ROLE_STEWARD_MANAGER' => 'steward-manager',
            'ROLE_STAFF' => 'staff',
        ];

        foreach ($roleToGroup as $role => $group) {
            if ($this->authorizationChecker->isGranted($role)) {
                $context['groups'][] = $normalization ? $group . ':read' :  $group . ':write';
            }
        }

        return $context;
    }
}
