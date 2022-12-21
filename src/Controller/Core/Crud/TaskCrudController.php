<?php

namespace App\Controller\Core\Crud;

use App\Entity\Core\Task as TaskEntity;

class TaskCrudController extends AbstractCrudWrapperController
{
    public static function getEntityFqcn(): string
    {
        return TaskEntity::class;
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
