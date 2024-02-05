<?php


namespace App\Repository;


use App\Entity\Matches;
use App\Entity\MatchUserScoreboard;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

class MatchUserScoreboardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatchUserScoreboard::class);
    }

    public function getAllOrderedByUser(User $user): array
    {
        $qb = $this->createQueryBuilder('m');

        return $qb
            ->join('m.matches', 'matches')
            ->orderBy('matches.matchTime', 'ASC')
            ->where($qb->expr()->eq('m.user', ':userid'))
            ->andWhere($qb->expr()->neq('matches.saved', ':false'))
            ->setParameters(['userid' => $user->getId(), 'false' => false])
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $id
     * @return MatchUserScoreboard[]|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByMatchIdSorted($id): array
    {
        $qb = $this->createQueryBuilder('mus');

        return $qb
            ->innerJoin(Matches::class, 'm', Join::WITH, 'mus.matches = m.id')
            ->where('m.id = :id')
            ->addOrderBy('mus.side', 'DESC')
            ->addOrderBy('mus.damage', 'DESC')
            ->setMaxResults(10)
            ->setParameters(['id' => $id])
            ->getQuery()
            ->getResult();
    }

    public function getAvgValues()
    {
        $qb = $this->createQueryBuilder('mus');

        return $qb
            ->select(
                'AVG(mus.kd) as avgkd',
                'AVG(mus.adr) as avgadr',
                'AVG(mus.hspercent) as avghspercent',
                'AVG(mus.hltvrating) as avghltvrating',
                'AVG(mus.kills) as avgkills',
                'AVG(mus.mvps) as avgmvps',
                'AVG(mus.deaths) as avgdeaths',
                'AVG(mus.assists) as avgassists'
            )
            ->getQuery()
            ->getOneOrNullResult();
    }
}