<?php

namespace App\Controller\Security;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CheckController extends AbstractController
{
    /**
     * @Route(path="/security/check", name="api_security_check")
     * @return JsonResponse
     * @IsGranted("ROLE_ARTICLES")
     */
    public function handleRequest(): JsonResponse
    {
        if (!$user = $this->getUser()) {
            return new JsonResponse(['user' => null]);
        }

        return new JsonResponse(['user' => $this->getUser()->getUsername(), 'roles' => $user->getRoles()]);
    }
}
