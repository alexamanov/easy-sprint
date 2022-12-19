<?php

namespace App\Repository\Core\Schedule;

use App\Entity\Core\Schedule\Chunk as ScheduleChunkEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ScheduleChunkEntity>
 *
 * @method ScheduleChunkEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ScheduleChunkEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ScheduleChunkEntity[]    findAll()
 * @method ScheduleChunkEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Chunk extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ScheduleChunkEntity::class);
    }

    public function save(ScheduleChunkEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ScheduleChunkEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ScheduleChunkEntity[] Returns an array of Chunk objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Chunk
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
