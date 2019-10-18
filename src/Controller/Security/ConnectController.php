<?php

namespace App\Controller\Security;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ConnectController
{
    /**
     * @Route(path="/security/connect", name="api_security_connect")
     * @return JsonResponse
     */
    public function handleRequest(): JsonResponse
    {
        return new JsonResponse();
    }
}
