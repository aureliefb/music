<?php

namespace App\Repository;

use App\Entity\Style;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MusicStyles>
 *
 * @method MusicStyles|null find($id, $lockMode = null, $lockVersion = null)
 * @method MusicStyles|null findOneBy(array $criteria, array $orderBy = null)
 * @method MusicStyles[]    findAll()
 * @method MusicStyles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MusicStylesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Style::class);
    }

    public function save(Style $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Style $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getChoices() {
        $choices = $this->createQueryBuilder('m')
            ->select('m.id', 'm.style')
            ->orderBy('m.style', 'ASC')
            ->getQuery()
            ->getResult();

        $arr = [];
        foreach ($choices as $k => $v) {
            $arr[$v["style"]] = $v["id"];
        }
        return $arr;
    }

//    /**
//     * @return MusicStyles[] Returns an array of MusicStyles objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MusicStyles
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
