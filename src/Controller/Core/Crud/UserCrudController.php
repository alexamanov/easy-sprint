<?php

namespace App\Controller\Core\Crud;

use App\Entity\Core\User as UserEntity;

class UserCrudController extends AbstractCrudWrapperController
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
