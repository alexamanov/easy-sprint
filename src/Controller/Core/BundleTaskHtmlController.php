<?php

namespace App\Controller\Core;

use App\Repository\Core\BundleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BundleTaskHtmlController extends AbstractController
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly BundleRepository $bundleRepository
    ) {
    }

    #[Route('/api/get-bundle-task-html', name: 'api_get_bundle_task_html')]
    public function getHtml(): Response
    {
        if (!$this->getUser()) {
            return new JsonResponse(['message' => 'You are not authorized']);
        }

        $html = '';
        $request = $this->requestStack->getCurrentRequest();

        $bundleId = (int) $request->get('bundleId');
        if ($bundleId) {
            $bundle = $this->bundleRepository->find($bundleId);
            if ($bundle && $bundle->getTasks()) {
                $html = $this->renderView(
                    'core/crud/field/list.html.twig',
                    [
                        'id' => 'tasks_multiselect',
                        'entityName' => 'Tasks',
                        'options' => $bundle->getTasks(),
                    ]
                );
            }
        }

        return new JsonResponse(['html' => $html]);
    }
}
