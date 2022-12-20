<?php

namespace App\Controller\Core\Crud\Schedule;

use App\Entity\Core\Schedule\Calendar as CalendarEntity;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CalendarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CalendarEntity::class;
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
