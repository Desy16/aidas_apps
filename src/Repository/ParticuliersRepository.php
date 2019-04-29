<?php

namespace App\Repository;

use App\Entity\Particuliers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Particuliers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Particuliers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Particuliers[]    findAll()
 * @method Particuliers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticuliersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Particuliers::class);
    }

    // /**
    //  * @return Particuliers[] Returns an array of Particuliers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Particuliers
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}