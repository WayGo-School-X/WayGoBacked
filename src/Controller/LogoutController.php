<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LogoutController
{
    private $tokenStorage;
    private $entityManager;

    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $entityManager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/logout", name="app_logout")
     */

    public function logout(): Response
    {
        // Получаем текущий токен из хранилища токенов
        $token = $this->tokenStorage->getToken();

        if (null !== $token) {
            $tokenValue = $token->getUser();

            if ($tokenValue instanceof Token) {
                $tokenValue->setRevoked(true);

                $this->entityManager->persist($tokenValue);
                $this->entityManager->flush();
            }

            // Удаляем токен из системы
            $this->tokenStorage->setToken(null);
        }

        return new Response('You have been successfully logged out');
    }
}