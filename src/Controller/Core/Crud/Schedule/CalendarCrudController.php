<?php

namespace App\Controller\Core\Crud\Schedule;

use App\Controller\Core\Crud\AbstractCrudWrapperController;
use App\Entity\Core\Schedule\Calendar as CalendarEntity;

class CalendarCrudController extends AbstractCrudWrapperController
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
