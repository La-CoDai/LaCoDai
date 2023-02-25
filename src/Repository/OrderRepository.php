<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 *
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function add(Order $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Order $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    
    /**
    * @return Order[] Returns an array of Cart objects
    */
    public function orderdetail($value): array
    {
        return $this->createQueryBuilder('o')
            ->select('o.id')
            ->andWhere('o.userorder = :id')
            ->setParameter('id', $value)
            ->orderBy('o.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return Order[] Returns an array of Order objects
    */
   public function orderTemplate(): array
   {
       return $this->createQueryBuilder('o')
           ->select('o.id, o.total, o.date')
           ->orderBy('o.id', 'DESC')
           ->setMaxResults(1)
           ->getQuery()
           ->getResult()
       ;
   }

    /**
    * @return Order[] Returns an array of Cart objects
    */
    public function showOrderByUserId($value): array
    {
        return $this->createQueryBuilder('o')
            ->select('o.id, o.date, o.total')
            ->andWhere('o.userorder = :id')
            ->setParameter('id', $value)
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return Order[] Returns an array of Order objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Order
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
