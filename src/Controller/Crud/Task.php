<?php

namespace App\Controller\Crud;

use App\Entity\Core\Task as TaskEntity;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class Task extends AbstractCrudController
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
