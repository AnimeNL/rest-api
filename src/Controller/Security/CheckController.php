<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CheckController extends AbstractController
{
    #[Route(path: '/security/check', name: 'api_security_check')]
    #[IsGranted('ROLE_ARTICLES')]
    public function handleRequest(): JsonResponse
    {
        if (!$user = $this->getUser()) {
            return new JsonResponse(['user' => null]);
        }

        return new JsonResponse(['user' => $user->getUserIdentifier(), 'roles' => $user->getRoles()]);
    }
}
