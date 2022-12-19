<?php

namespace App\Controller\Crud;

use App\Entity\User as UserEntity;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class User extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserEntity::class;
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
