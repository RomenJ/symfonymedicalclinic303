<?php

namespace App\Repository;

use App\Entity\Trat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Trat>
 *
 * @method Trat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trat[]    findAll()
 * @method Trat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TratRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trat::class);
    }

    public function save(Trat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Trat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findMyTrats(): array
    {   
        return $this->createQueryBuilder('e')
        ->orderBy('e.id', 'DESC')
        ->getQuery()
        ->getResult();
        ;
    }

//    /**
//     * @return Trat[] Returns an array of Trat objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Trat
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
