<?php

namespace App\Repository;

use App\Entity\AppMailContacts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AppMailContacts>
 *
 * @method AppMailContacts|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppMailContacts|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppMailContacts[]    findAll()
 * @method AppMailContacts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppMailContactsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AppMailContacts::class);
    }

    public function save(AppMailContacts $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AppMailContacts $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AppMailContacts[] Returns an array of AppMailContacts objects
//     */
//    public function FilterContact($value1, $value2): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val1')
//            ->andWhere('a.exampleField = :val2')

//            ->setParameter('val1', $value1)
//            ->setParameter('val2', $value2)

//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AppMailContacts
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
