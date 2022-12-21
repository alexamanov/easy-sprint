<?php

namespace App\Controller\Core\Crud;

use App\Entity\Core\Sprint as SprintEntity;
use App\Service\Core\GetAllBundlesForChoice;
use App\Source\Sprint\Status;
use Doctrine\ORM\EntityManagerInterface;
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
        $bundleChoiceField = Field\ChoiceField::new('bundle_id')
            ->setTemplatePath('core/crud/field/bundle_choice.html.twig')
            ->hideOnIndex()
            ->setChoices($this->getAllBundlesForChoice->execute());

        $statusField = Field\ChoiceField::new('status')->hideWhenCreating()
            ->setChoices(Status::getStatuses());

        return [
            Field\TextField::new('name'),
            $statusField,
            Field\DateField::new('start'),
            Field\DateField::new('end'),
            Field\ArrayField::new('tasks')->hideOnIndex(),
            $bundleChoiceField,
        ];
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param SprintEntity $entityInstance
     *
     * @return void
     */
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance->getStatus()) {
            $entityInstance->setStatus(Status::READY_TO_START);
        }

        parent::persistEntity($entityManager, $entityInstance);
    }
}
