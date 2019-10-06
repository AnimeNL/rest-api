<?php

namespace App\Controller\Security;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CheckController extends AbstractController
{
    /**
     * @Route(path="/security/check", name="api_security_check")
     * @param ClientRegistry $clientRegistry
     * @return JsonResponse
     */
    public function handleRequest(ClientRegistry $clientRegistry): JsonResponse
    {
        if (!$this->getUser()) {
            return new JsonResponse(['user' => null]);
        }

        return new JsonResponse(['user' => $this->getUser()->getUsername()]);
    }
}
