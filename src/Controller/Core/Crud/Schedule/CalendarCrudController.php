<?php

namespace App\Controller\Core\Crud\Schedule;

use App\Controller\Core\Crud\AbstractCrudWrapperController;
use App\Entity\Core\Schedule\Calendar as CalendarEntity;
use App\Service\Core\GetSprintsForChoice;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class CalendarCrudController extends AbstractCrudWrapperController
{
    public function __construct (
        private readonly GetSprintsForChoice $getSprintsForChoice
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return CalendarEntity::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $sprintField = ChoiceField::new('sprint_id', 'Sprint')
            ->setChoices($this->getSprintsForChoice->execute());

        return [
            IdField::new('id')->onlyOnIndex(),
            $sprintField,
        ];
    }
}
