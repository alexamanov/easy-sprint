<?php

namespace App\Controller\Api\Bundle;

use App\Repository\Core\BundleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    public const BUNDLE_ID_PARAM = 'bundle_id';

    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly BundleRepository $bundleRepository
    ) {
    }

    #[Route('/api/bundle/task/get')]
    public function get(): JsonResponse
    {
        if (!$this->getUser()) {
            return new JsonResponse(['message' => 'You are not authorized']);
        }

        $tasks = [];
        $request = $this->requestStack->getCurrentRequest();

        $bundleId = (int) $request->get(self::BUNDLE_ID_PARAM, 0);
        if ($bundleId) {
            $bundle = $this->bundleRepository->find($bundleId);
            if ($bundle && !empty($bundle->getTasks())) {
                $tasks = $bundle->getTasks();
            }
        }

        return new JsonResponse(['tasks' => $tasks]);
    }
}
