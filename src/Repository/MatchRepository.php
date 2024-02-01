<?php

namespace App\Repository;

use App\Entity\Matches;
use App\Entity\MatchUserScoreboard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Matches|null find($id, $lockMode = null, $lockVersion = null)
 * @method Matches|null findOneBy(array $criteria, array $orderBy = null)
 * @method Matches[]    findAll()
 * @method Matches[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Matches::class);
    }

    /**
     * @param $id
     * @return array
     */
    public function findByMatchIdSorted($id): array
    {
        $qb = $this->createQueryBuilder('m');

        return $qb
            ->select('mus')
            ->innerJoin(MatchUserScoreboard::class, 'mus', Join::WITH, 'm.id = mus.match')
            ->where('m.id = :id')
            ->addOrderBy('mus.side', 'DESC')
            ->addOrderBy('mus.hltvrating', 'DESC')
            ->setParameters(['id' => $id])
            ->getQuery()
            ->getResult();

    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCount()
    {
        $qb = $this->createQueryBuilder('m');

        return $qb
            ->select('COUNT(m)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getMatchStats()
    {
        $qb = $this->createQueryBuilder('m');

        return $qb
            ->select('COUNT(m) as count,CAST(m.matchTime as date) AS matchTime')
            ->addGroupBy('matchTime')
            ->getQuery()
            ->getResult();
    }
}
