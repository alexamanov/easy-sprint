<?php

namespace App\Controller\Core\Crud;

use App\Entity\Core\Sprint as SprintEntity;
use App\Service\Core\GetAllBundlesForChoice;
use EasyCorp\Bundle\EasyAdminBundle\Field;

class SprintCrudController extends AbstractCrudWrapperController
{
    public function __construct(private readonly GetAllBundlesForChoice $getAllBundlesForChoice) {
    }

    public static function getEntityFqcn(): string
    {
        return SprintEntity::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $bundleChoiceField = Field\ChoiceField::new('bundle')
            ->setChoices($this->getAllBundlesForChoice->execute());

        return [
            Field\TextField::new('name'),
            Field\DateField::new('start'),
            Field\DateField::new('end'),
            Field\ArrayField::new('tasks'),
            $bundleChoiceField,
        ];
    }
}
