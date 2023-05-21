<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\GeoRegion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GeoRegion>
 *
 * @method GeoRegion|null find($id, $lockMode = null, $lockVersion = null)
 * @method GeoRegion|null findOneBy(array $criteria, array $orderBy = null)
 * @method GeoRegion[]    findAll()
 * @method GeoRegion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeoRegionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeoRegion::class);
    }

    public function remove(GeoRegion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function save(GeoRegion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return GeoRegion[] Returns an array of GeoRegion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GeoRegion
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
