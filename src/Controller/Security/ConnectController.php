<?php

namespace App\Controller\Security;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ConnectController
{
    /**
     * @Route(path="/security/connect", name="api_security_connect")
     * @param ClientRegistry $clientRegistry
     * @return JsonResponse
     */
    public function handleRequest(ClientRegistry $clientRegistry): JsonResponse
    {
        $targetUrl = $clientRegistry->getClient('anime')->redirect()->getTargetUrl();

        return new JsonResponse([
            'redirectUrl' => $targetUrl,
        ]);
    }
}
