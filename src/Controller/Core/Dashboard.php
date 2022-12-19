<?php

namespace App\Controller\Core;

use App\Entity\Core;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard as ConfigDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Dashboard extends AbstractDashboardController
{
    #[Route('/', name: 'dashboard')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //

        return $this->render('@EasyAdmin/layout.html.twig');
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
