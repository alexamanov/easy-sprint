<?php

namespace App\Controller\Core\Crud;

use App\Entity\Core\Sprint as SprintEntity;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SprintCrudController extends AbstractCrudWrapperController
{
    public static function getEntityFqcn(): string
    {
        return SprintEntity::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            DateField::new('start'),
            DateField::new('end'),
            ArrayField::new('tasks')
        ];
    }
}
