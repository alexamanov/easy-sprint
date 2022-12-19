<?php

namespace App\Controller\Core\Crud;

use App\Entity\Core\Bundle as BundleEntity;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class Bundle extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BundleEntity::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
