<?php

namespace App\Controller;
namespace App\Controller;
use ApiPlatform\Metadata\Put;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ApiPlatform\Metadata\Get;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/users", name="get_users", methods={"GET"})
     */
    public function GetCollection(): JsonResponse
    {
        // Получаем всех пользователей из базы данных
        $users = $this->entityManager->getRepository(User::class)->findAll();

        // Возвращаем ответ с кодом 200 OK и списком пользователей
        return $this->json([
            'users' => $users,
        ]);
    }


    /**
 * @Route("/users/{id}", name="get_user", methods={"GET"})
 */
    public function get(int $id): JsonResponse
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        return $this->json($user);
    }
    /**
     * @Route("/users/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(User $user, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($user);
        $entityManager->flush();

        return new JsonResponse(['message' => 'User deleted']);
    }
    /**
     * @Route("/users/{id}", name="post_user", methods={"POST"})
     */
    public function Post(Request $request): JsonResponse
    {
        // Получаем данные из тела запроса
        $data = json_decode($request->getContent(), true);

        // Создаем новую сущность пользователя на основе полученных данных
        $user = new User();
        $user->setName($data['name'] ?? '');
        $user->setPassword($data['password'] ?? '');
        $user->setEmail($data['email'] ?? '');

        // Сохраняем изменения в базе данных
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Возвращаем ответ с кодом 201 CREATED и данными пользователя в теле ответа
        return $this->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], JsonResponse::HTTP_CREATED);
    }
    /**
     * @Route("/users/{id}", name="put_user", methods={"PUT"})
     */
    public function Put(Request $request, User $user): JsonResponse
    {
        // Получаем данные из тела запроса
        $data = json_decode($request->getContent(), true);

        // Обновляем свойства пользователя согласно переданным данным
        $user->setName($data['name'] ?? $user->getName());
        $user->setEmail($data['email'] ?? $user->getEmail());
        $user->setPassword($data['password'] ?? $user->setPassword());


        // Сохраняем изменения в базе данных
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Возвращаем ответ с кодом 200 OK
        return new JsonResponse(['message' => 'User created successfully', 'id' => $user->getId()]);
    }
    /**
     * @Route("/users/{id}", name="update_user", methods={"PATCH"})
     */
    public function Patch(Request $request, User $user): JsonResponse
    {
        // Получаем данные из тела запроса
        $data = json_decode($request->getContent(), true);

        // Обновляем свойства пользователя согласно переданным данным
        if (isset($data['name'])) {
            $user->setName($data['name']);
        }
        if (isset($data['email'])) {
            $user->setEmail($data['email']);
        }
        if (isset($data['password'])) {
            $user->setPassword($data['password']);
        }

        // Сохраняем изменения в базе данных
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        // Возвращаем ответ с кодом 200 OK
        return $this->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ]);
    }
}
