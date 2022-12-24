<?php

namespace App\Controller\Api;

use App\Repository\Core\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(
       private readonly UserRepository $userRepository
    ) {
    }

    #[Route('/api/user', name: 'get_users', methods: ['GET'])]
    public function getList(): JsonResponse
    {
        if (!$this->getUser()) {
            return new JsonResponse(['message' => 'You are not authorized']);
        }

        $users = $this->userRepository->findAll();

        return new JsonResponse(['users' => $users]);
    }
}
