<?php

namespace App\Repository;

use App\Entity\Products;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Products>
 *
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Products::class);
    }

    public function add(Products $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Products $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Products[] Returns an array of Products objects
    */
   public function findAllProduct_8item(): array
   {
       return $this->createQueryBuilder('p')
           ->orderBy('p.id', 'DESC')
           ->setMaxResults(8)
           ->getQuery()
           ->getResult()
       ;
   }

    /**
    * @return Products[] Returns an array of Products objects
    */
    public function findRelativeProduct($brid): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.brand = :val')
            ->setParameter('val', $brid)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getArrayResult()
        ;
    }


    /**
    * @return Products[] Returns an array of Products objects
    */
    public function findProductBrand($id): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.brand = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult()
        ;
    }


    /**
    * @return Products[] Returns an array of Products objects
    */
   public function findProduct($name): array
   {
       return $this->createQueryBuilder('p')
           ->andWhere('p.pname like :name')
           ->setParameter('name', '%'.$name.'%')
           ->orderBy('p.id', 'ASC')
           ->getQuery()
           ->getArrayResult()
       ;
   }

    /**
    * @return Products[] Returns an array of Products objects
    */
    public function findProductSale($gd): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.pgender = :gd')
            ->setParameter('gd', $gd)
            ->getQuery()
            ->getArrayResult()
        ;
    }

    /**
    * @return Products[] Returns an array of Products objects
    */
   public function findAllSeeBrand(): array
   {
       return $this->createQueryBuilder('p')
           ->select('p.id, p.pname, p.pprice, p.pimg, p.pgender, p.pdes, br.bname')
           ->innerJoin('p.brand','br')
           ->orderBy('p.id', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }


//    /**
//     * @return Products[] Returns an array of Products objects
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

//    public function findOneBySomeField($value): ?Products
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
