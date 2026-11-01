<?php

namespace App\Controller\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ConnectController
{
    #[Route(path: '/security/connect', name: 'api_security_connect')]
    public function handleRequest(): JsonResponse
    {
        return new JsonResponse();
    }
}
