<?php

namespace App\Repository;

use App\Entity\Pato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pato>
 *
 * @method Pato|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pato|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pato[]    findAll()
 * @method Pato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pato::class);
    }

    public function save(Pato $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Pato $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findMyPathos(): array
    {   
        return $this->createQueryBuilder('e')
        ->orderBy('e.id', 'DESC')
        ->getQuery()
        ->getResult();
        ;
    }

//    /**
//     * @return Pato[] Returns an array of Pato objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Pato
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
