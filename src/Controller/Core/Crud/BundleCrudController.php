<?php

namespace App\Controller\Core\Crud;

use App\Entity\Core\Bundle as BundleEntity;
use App\Service\Handler\Save\Bundle\TaskSaveHandler;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field;

class BundleCrudController extends AbstractCrudWrapperController
{
    public function __construct(
        private readonly TaskSaveHandler $taskSaveHandler
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return BundleEntity::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        $crud = parent::configureCrud($crud);
        $crud->setPageTitle(Crud::PAGE_INDEX, 'Task Bundle');

        return $crud;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field\IdField::new('id')->onlyOnIndex(),
            Field\TextField::new('name'),
            Field\ArrayField::new('tasks'),
            Field\DateTimeField::new('created_at')->hideOnForm(),
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

        $this->taskSaveHandler->save($entityInstance);

        parent::persistEntity($entityManager, $entityInstance);
    }
}
