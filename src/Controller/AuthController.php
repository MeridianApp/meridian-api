<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/auth')]
final class AuthController extends AbstractController
{
    /**
     * Intercepted by the security firewall before reaching this method.
     * The json_login authenticator handles the request and returns the JWT.
     */
    #[Route('/login', name: 'api_auth_login', methods: ['POST'])]
    public function login(): JsonResponse
    {
        throw new \LogicException('The security firewall should intercept this route.');
    }

    /**
     * Intercepted by the refresh_jwt authenticator before reaching this method.
     * Validates the refresh token and returns a new JWT pair.
     */
    #[Route('/refresh', name: 'api_auth_refresh', methods: ['POST'])]
    public function refresh(): JsonResponse
    {
        throw new \LogicException('The security firewall should intercept this route.');
    }
}
