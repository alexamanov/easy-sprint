<?php

namespace App\Controller\Core\Crud;

use App\Entity\Core\Bundle as BundleEntity;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BundleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BundleEntity::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            ArrayField::new('tasks'),
        ];
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param BundleEntity $entityInstance
     *
     * @return void
     */
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance->getCreatedAt()) {
            $entityInstance->setCreatedAt(new \DateTimeImmutable());
        }

        parent::persistEntity($entityManager, $entityInstance);
    }
}
