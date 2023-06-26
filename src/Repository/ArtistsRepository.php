<?php

namespace App\Repository;

use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Query\Expr\Join;
use App\Entity\Artists;
use App\Entity\ArtistSearch;
use App\Entity\MusicStyles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Artists>
 *
 * @method Artists|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artists|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artists[]    findAll()
 * @method Artists[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artists::class);
    }

    public function save(Artists $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Artists $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findMyChoice(ArtistSearch $search) {
        $query =  $this->createQueryBuilder('a');

        if($search->getArtistName() != '' || $search->getMusicStyle() != '') {
            if($search->getArtistName()) {
                $query = $query
                    ->leftJoin('App\Entity\MusicStyles', 'm', Join::WITH, 'm.id_music_styles = a.id_style')
                    ->where("a.artist like concat('%', :name, '%')")
                    ->setParameter(":name", $search->getArtistName())
                    ->orderBy('a.artist', 'ASC');
            } 
            if($search->getMusicStyle()) {
                $query = $query
                    ->andWhere('a.id_style = :id')
                    ->setParameter(':id', $search->getMusicStyle())
                    ->orderBy('a.artist', 'ASC');
            }
        } else {
            $query = $query->orderBy('a.artist', 'ASC');
        }
        return $query->getQuery();
    }

  //  /**
  //   * @return Artists[] Returns an array of Artists objects
  //   */
   /* public function getArtistsAndStyles(): array
    {
        $db = $this->createQueryBuilder('a');
        $query = $db->select('a', 'm')
            ->from('artists', 'a')
            ->leftJoin('a.id_music_styles', 'm')
            //->andWhere('a.exampleField = :val')
            //->setParameter('val', $value)
            //->orderBy('a.artist', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
        return $query;
    }*/

   /*private function findOneArtist($value): QueryBuilder
   {
       return $this->createQueryBuilder('a')
           ->andWhere('a.artist = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }*/



}
