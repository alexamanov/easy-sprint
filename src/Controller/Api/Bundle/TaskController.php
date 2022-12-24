<?php

namespace App\Controller\Api\Bundle;

use App\Repository\Core\BundleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    public function __construct(
        private readonly BundleRepository $bundleRepository
    ) {
    }

    #[Route('/api/bundle/task/{id}', name: 'get_bundle_tasks', methods: ['GET'])]
    public function get(?int $id = null): JsonResponse
    {
        if (!$this->getUser()) {
            return new JsonResponse(['message' => 'You are not authorized']);
        }

        $tasks = [];
        if ($id) {
            $bundle = $this->bundleRepository->find($id);
            if ($bundle && !empty($bundle->getTasks())) {
                $tasks = $bundle->getTasks();
            }
        }

        return new JsonResponse(['tasks' => $tasks]);
    }
}
