<?php

namespace App\Controller\Api;

use App\Repository\Core\SprintRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SprintController extends AbstractController
{
    public function __construct(
       private readonly SprintRepository $sprintRepository
    ) {
    }

    #[Route('/api/sprint/{id}', name: 'get_sprint', methods: ['GET'])]
    public function get(?int $id = null): JsonResponse
    {
        if (!$this->getUser()) {
            return new JsonResponse(['message' => 'You are not authorized']);
        }

        $sprint = null;
        if ($id) {
            $sprint = $this->sprintRepository->find($id);
        }

        return new JsonResponse(['sprint' => $sprint]);
    }
}
