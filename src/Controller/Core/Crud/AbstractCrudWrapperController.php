<?php

namespace App\Controller\Core\Crud;

use App\Security\StandardAuthenticator;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

abstract class AbstractCrudWrapperController extends AbstractCrudController
{
    public function index(AdminContext $context)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute(StandardAuthenticator::LOGIN_ROUTE);
        }

        return parent::index($context);
    }
}
