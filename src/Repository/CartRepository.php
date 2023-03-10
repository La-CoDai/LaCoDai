<?php

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cart>
 *
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    public function add(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//     SELECT p.id, p.pname, p.pprice, quantity, p.pprice*quantity as total
// FROM `cart` as c
// INNER JOIN `products` AS p on p.id = c.procart_id
// WHERE usercart_id = 4
   /**
    * @return Cart[] Returns an array of Cart objects
    */
   public function showCartByUserId($value): array
   {
       return $this->createQueryBuilder('c')
       ->select('p.id, p.pimg, p.pname, p.pprice, c.quantity, p.pprice*c.quantity as total')
            ->innerJoin('c.procart','p')
           ->andWhere('c.usercart = :id')
           ->setParameter('id', $value)
           ->getQuery()
           ->getResult()
       ;
   }

    /**
    * @return Cart[] Returns an array of Cart objects
    */
    public function findCart($value): array
    {
        return $this->createQueryBuilder('c')
        ->select('p.id, c.quantity, p.pprice*c.quantity as total')
             ->innerJoin('c.procart','p')
            ->andWhere('c.usercart = :id')
            ->setParameter('id', $value)
            ->getQuery()
            ->getResult()
        ;
    }




//    /**
//     * @return Cart[] Returns an array of Cart objects
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

//    public function findOneBySomeField($value): ?Cart
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
