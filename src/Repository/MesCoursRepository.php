<?php

namespace App\Repository;

use App\Entity\MesCours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MesCours|null find($id, $lockMode = null, $lockVersion = null)
 * @method MesCours|null findOneBy(array $criteria, array $orderBy = null)
 * @method MesCours[]    findAll()
 * @method MesCours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MesCoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MesCours::class);
    }

    // /**
    //  * @return MesCours[] Returns an array of MesCours objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MesCours
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
