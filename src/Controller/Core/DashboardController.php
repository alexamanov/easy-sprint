<?php

namespace App\Controller\Core;

use App\Controller\Core\Crud\SprintCrudController;
use App\Entity\Core;
use App\Security\StandardAuthenticator;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard as ConfigDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class DashboardController extends AbstractDashboardController
{
    #[Route('/', name: 'dashboard')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute(StandardAuthenticator::LOGIN_ROUTE);
        }

        try {
            $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
            $newSprintUrl = $adminUrlGenerator->setController(SprintCrudController::class)
                ->setAction(Action::NEW)
                ->generateUrl();
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
        }

        return $this->render(
            'core/dashboard.html.twig',
            [
                'new_sprint_url' => $newSprintUrl ?? null,
            ]
        );
    }

    public function configureDashboard(): ConfigDashboard
    {
        return ConfigDashboard::new()
            ->setTitle('Easy Sprint');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Sprints', 'fa-sharp fa-solid fa-person-running', Core\Sprint::class);
        yield MenuItem::linkToCrud('Schedule', 'fa-solid fa-calendar-days', Core\Schedule\Calendar::class);
        yield MenuItem::linkToCrud('Bundles', 'fa-solid fa-file-zipper', Core\Bundle::class);
        yield MenuItem::linkToCrud('Team', 'fa-solid fa-people-group', Core\User::class);
        yield MenuItem::linkToCrud('Tasks', 'fa-solid fa-list-check', Core\Task::class);
    }
}
