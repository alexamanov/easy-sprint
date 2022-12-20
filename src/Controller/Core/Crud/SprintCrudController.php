<?php

namespace App\Controller\Core\Crud;

use App\Entity\Core\Sprint as SprintEntity;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SprintCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SprintEntity::class;
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
