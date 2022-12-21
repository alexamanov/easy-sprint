<?php

namespace App\Controller\Core\Crud;

use App\Entity\Core\Sprint as SprintEntity;

class SprintCrudController extends AbstractCrudWrapperController
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
