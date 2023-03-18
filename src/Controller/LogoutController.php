<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LogoutController
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/logout", name="app_logout")
     */

    public function logout(): Response
    {
        // Удаляем токен из системы
        $this->tokenStorage->setToken(null);

        return new Response('You have been successfully logged out');
    }
}