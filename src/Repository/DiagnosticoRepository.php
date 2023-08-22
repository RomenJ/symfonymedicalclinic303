<?php

namespace App\Repository;

use App\Entity\Diagnostico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Diagnostico>
 *
 * @method Diagnostico|null find($id, $lockMode = null, $lockVersion = null)
 * @method Diagnostico|null findOneBy(array $criteria, array $orderBy = null)
 * @method Diagnostico[]    findAll()
 * @method Diagnostico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiagnosticoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Diagnostico::class);
    }

    public function save(Diagnostico $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Diagnostico $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findMyDiagnosys(): array
    {   
        return $this->createQueryBuilder('e')
        ->orderBy('e.id', 'DESC')
        ->getQuery()
        ->getResult();
        ;
    }

//    /**
//     * @return Diagnostico[] Returns an array of Diagnostico objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Diagnostico
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
