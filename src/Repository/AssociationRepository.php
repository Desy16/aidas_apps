<?php

namespace App\Repository;

use App\Entity\Association;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Form\AssociationType;
use App\Entity\AssociationSearch;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * @method Association|null find($id, $lockMode = null, $lockVersion = null)
 * @method Association|null findOneBy(array $criteria, array $orderBy = null)
 * @method Association[]    findAll()
 * @method Association[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Association::class);
    }


    /**
     * Permet de récuperer tout ce qui est visible
    * @return Query
    */
    public function findAllVisibleQuery(AssociationSearch $search)
    {
        
        $query = $this->findVisibleQuery();

        $query = $query
            ->where('a.commune == :maxcommune')
            ->setParameter(':maxcommune', $search->getCommune());
            
        return $query->getQuery();
    }

    /**
     * Permet de récuperer les deux derniers résultats
    * @return Association[]
    */
    public function findLatest(): array
    {
        # code...
        return $this->findVisibleQuery()
                    ->getQuery()
                    ->setMaxResults(4)
                    ->getResult()
                ;

    }

    private function findVisibleQuery()
    {
        # code...
        return $this->createQueryBuilder('a');
    }

    // /**
    //  * @return Association[] Returns an array of Association objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Association
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
