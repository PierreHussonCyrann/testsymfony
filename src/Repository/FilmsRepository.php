<?php

namespace App\Repository;

use App\Entity\Films;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Films|null find($id, $lockMode = null, $lockVersion = null)
 * @method Films|null findOneBy(array $criteria, array $orderBy = null)
 * @method Films[]    findAll()
 * @method Films[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Films::class);
    }

//    /**
//     * @return Films[] Returns an array of Films objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Films
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function FindCountFilms(){
        $qb = $this->createQueryBuilder('f');

        $qb -> select('COUNT(f.titre) as nb');

        return $qb->getQuery()
            ->getSingleResult()["nb"];
    }

    public function Search(array $search){
        $qb = $this->createQueryBuilder('f');

        $qb->where('f.titre LIKE :titre', 'f.categorie=:categorie' )

        ->setParameters(array('titre'=>'%'.$search['titre'].'%', 'categorie'=>$search['categorie']));
        $query = $qb->getQuery()->getResult();
        return $query;
    }

}