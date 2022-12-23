<?php

namespace App\Controller\Core\Crud;

use App\Entity\Core\Sprint as SprintEntity;
use App\Service\Core\GetAllBundlesForChoice;
use App\Source\Sprint\Status;
use App\Ui\Component\Form\Extension\Core\Type\ChoiceWithListType;
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
        $bundleChoiceField = Field\ChoiceField::new('bundle_id', 'Task Bundle')
            ->hideOnIndex()
            ->addFormTheme('form/fields.html.twig')
            ->setFormType(ChoiceWithListType::class)
            ->setChoices($this->getAllBundlesForChoice->execute());

        $statusField = Field\ChoiceField::new('status')->hideWhenCreating()
            ->setChoices(Status::getStatuses());

        return [
            Field\IdField::new('id')->onlyOnIndex(),
            Field\TextField::new('name'),
            $statusField,
            Field\DateField::new('start'),
            Field\DateField::new('end'),
            Field\ArrayField::new('tasks')->hideOnIndex(),
            $bundleChoiceField
        ];
    }
}
