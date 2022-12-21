<?php

namespace App\Controller\Core\Crud;

use App\Security\StandardAuthenticator;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractCrudWrapperController extends AbstractCrudController
{
    public function index(AdminContext $context): KeyValueStore|RedirectResponse|Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute(StandardAuthenticator::LOGIN_ROUTE);
        }

        return parent::index($context);
    }
}
