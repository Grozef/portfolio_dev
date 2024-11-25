<?php

namespace App\Repository;

use App\Entity\JoliDessin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JoliDessin>
 *
 * @method JoliDessin|null find($id, $lockMode = null, $lockVersion = null)
 * @method JoliDessin|null findOneBy(array $criteria, array $orderBy = null)
 * @method JoliDessin[]    findAll()
 * @method JoliDessin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JoliDessinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JoliDessin::class);
    }

//    /**
//     * @return JoliDessin[] Returns an array of JoliDessin objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JoliDessin
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
