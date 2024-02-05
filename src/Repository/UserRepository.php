<?php

namespace App\Repository;

use App\Entity\Matches;
use App\Entity\MatchUserScoreboard;
use App\Entity\Skin;
use App\Entity\User;
use App\Entity\UserMatchAccuracyWeapons;
use App\Entity\UserMatchDamageWeapons;
use App\Entity\UserMatchHeadshotsWeapons;
use App\Entity\UserMatchHitsWeapons;
use App\Entity\UserMatchShotsWeapons;
use App\Entity\UserSkin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    /**
     * @var \Doctrine\ORM\QueryBuilder
     */
    private $qb;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getCount()
    {
        $qb = $this->createQueryBuilder('u');
        $sql = $qb->select('COUNT(u.id) as count')
            ->where($qb->expr()->isNotNull('u.avatar'))
            ->addOrderBy('u.createdAt', 'DESC');

        return $sql->getQuery()->getSingleScalarResult();
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getAccuracyStats(User $user)
    {
        $qb = $this->createQueryBuilder('u');
        $query = $qb->select(
            'u.id',
            'AVG(acc.value) as avg',
            'acc.weapon as weapon',
        )
            ->innerJoin(UserMatchAccuracyWeapons::class, 'acc', Join::WITH, 'acc.user = u.id')
            ->where('u.id = :userid')
            ->setParameters(['userid' => $user->getId()])
            ->addGroupBy('u.id')
            ->addGroupBy('weapon')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getDamageStats(User $user)
    {
        $qb = $this->createQueryBuilder('u');
        $query = $qb->select(
            'u.id',
            'AVG(dmg.value) as avg',
            'dmg.weapon as weapon',
        )
            ->innerJoin(UserMatchDamageWeapons::class, 'dmg', Join::WITH, 'dmg.user = u.id')
            ->where('u.id = :userid')
            ->setParameters(['userid' => $user->getId()])
            ->addGroupBy('u.id')
            ->addGroupBy('weapon')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getHeadshotsStats(User $user)
    {
        $qb = $this->createQueryBuilder('u');
        $query = $qb->select(
            'u.id',
            'AVG(hs.value) as avg',
            'hs.weapon as weapon',
        )
            ->innerJoin(UserMatchHeadshotsWeapons::class, 'hs', Join::WITH, 'hs.user = u.id')
            ->where('u.id = :userid')
            ->setParameters(['userid' => $user->getId()])
            ->addGroupBy('u.id')
            ->addGroupBy('weapon')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getHitsStats(User $user)
    {
        $qb = $this->createQueryBuilder('u');
        $query = $qb->select(
            'u.id',
            'AVG(hits.value) as avg',
            'hits.weapon as weapon',
        )
            ->innerJoin(UserMatchHitsWeapons::class, 'hits', Join::WITH, 'hits.user = u.id')
            ->where('u.id = :userid')
            ->setParameters(['userid' => $user->getId()])
            ->addGroupBy('u.id')
            ->addGroupBy('weapon')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getShootsStats(User $user)
    {
        $qb = $this->createQueryBuilder('u');
        $query = $qb->select(
            'u.id',
            'AVG(shoots.value) as avg',
            'shoots.weapon as weapon',
        )
            ->innerJoin(UserMatchShotsWeapons::class, 'shoots', Join::WITH, 'shoots.user = u.id')
            ->where('u.id = :userid')
            ->setParameters(['userid' => $user->getId()])
            ->addGroupBy('u.id')
            ->addGroupBy('weapon')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @return mixed
     */
    public function findLatestUsers()
    {
        $qb = $this->createQueryBuilder('u');

        return $qb
            ->innerJoin(MatchUserScoreboard::class, 'mus', Join::WITH, 'mus.user = u.id')
            ->where($qb->expr()->isNotNull('u.avatar'))
            ->addOrderBy('u.createdAt', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    public function getMates(User $user)
    {
        $qb = $this->createQueryBuilder('u');

        return $qb
            ->select(
                'mates.steamusername',
                'mates.vacbanned',
                'mates.owbanned',
                'mates.steamId',
                'mates.id as mateid',
                'musmates.id as musmatesid',
                'musmates.rank',
                'musmates.hltvrating',
                'AVG(musmates.adr) as avgadr',
                'AVG(musmates.kd) as avgkd',
                'AVG(musmates.hspercent) as avghspercent',
                'AVG(musmates.hltvrating) as avghltvrating',
                'count(m.id) as playedCount'
            )
            ->innerJoin(MatchUserScoreboard::class, 'mus', Join::WITH, 'mus.user = u.id')
            ->innerJoin(Matches::class, 'm', Join::WITH, 'm.id = mus.matches')
            ->innerJoin(MatchUserScoreboard::class, 'musmates', Join::WITH, 'musmates.matches = m.id')
            ->innerJoin(User::class, 'mates', Join::WITH, 'mates.id = musmates.user')
            ->where('u.id = :userid')
            ->andWhere($qb->expr()->eq('musmates.side', 'mus.side'))
            ->andWhere($qb->expr()->neq('musmates.user', ':ownuserid'))
            ->andWhere($qb->expr()->gt('musmates.rank', 0))
            ->setParameters(['userid' => $user->getId(), 'ownuserid' => $user->getId()])
            ->addOrderBy('playedCount', 'DESC')
            ->addOrderBy('m.matchTime', 'DESC')
            ->addOrderBy('musmates.hltvrating', 'DESC')
            ->addGroupBy('mates.id')
            ->getQuery()
            ->getResult();
    }

    public function getAllUserAvgValues()
    {
        $qb = $this->createQueryBuilder('u');

        $query = $qb
            ->select(
                'u.id as userid',
                'u.steamusername',
                'u.avatar',
                'MAX(mus.rank) as rank',
                'mus.hltvrating',
                'u.timecreated',
                'u.steamId',
                'u.vacbanned',
                'u.owbanned',
                'AVG(mus.rank) as avgrank',
                'AVG(mus.kd) as avgkd',
                'AVG(mus.adr) as avgadr',
                'AVG(mus.hspercent) as avghspercent',
                'AVG(mus.hltvrating) as avghltvrating',
                'AVG(mus.kills) as avgkills',
                'AVG(mus.mvps) as avgmvps',
                'AVG(mus.deaths) as avgdeaths',
                'AVG(mus.assists) as avgassists',
                'count(m.id) as playedCount'
            )
            ->innerJoin(MatchUserScoreboard::class, 'mus', Join::WITH, 'mus.user = u.id')
            ->innerJoin(Matches::class, 'm', Join::WITH, 'm.id = mus.matches')
            ->where($qb->expr()->isNotNull('u.steamusername'))
            ->addOrderBy('playedCount', 'DESC')
            ->addOrderBy('m.matchTime', 'DESC')
            ->addGroupBy('u.id')
            ->getQuery();

        return $query
            ->getResult();
    }

    public function getUserAvgValuesByUser(User $user)
    {
        $qb = $this->createQueryBuilder('u');

        $and = $qb->expr()->andX();
        $and->add($qb->expr()->eq('u.id', $user->getId()));
        $and->add($qb->expr()->gt('mus.rank', 0));

        return $qb
            ->select(
                'u.id as userid',
                'u.steamusername',
                'u.avatar',
                'MAX(mus.rank) as rank',
                'mus.hltvrating',
                'u.timecreated',
                'u.steamId',
                'u.vacbanned',
                'u.owbanned',
                'AVG(mus.rank) as avgrank',
                'AVG(mus.kd) as avgkd',
                'AVG(mus.adr) as avgadr',
                'AVG(mus.hspercent) as avghspercent',
                'AVG(mus.hltvrating) as avghltvrating',
                'AVG(mus.kills) as avgkills',
                'AVG(mus.mvps) as avgmvps',
                'AVG(mus.deaths) as avgdeaths',
                'AVG(mus.assists) as avgassists',
                'count(m.id) as playedCount'
            )
            ->innerJoin(MatchUserScoreboard::class, 'mus', Join::WITH, 'mus.user = u.id')
            ->innerJoin(Matches::class, 'm', Join::WITH, 'm.id = mus.matches')
            ->where('u.id = :userid')
            ->setParameters(['userid' => $user->getId()])
            ->addOrderBy('playedCount', 'DESC')
            ->addOrderBy('m.matchTime', 'DESC')
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return User|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneWithKnownCode(): ?User
    {
        $qb = $this->createQueryBuilder('u');

        return $qb
            ->where($qb->expr()->isNotNull('u.knownCode'))
            ->addOrderBy('u.lastdemosearch', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

    }

    /**
     * @param int $limit
     * @return float|int|mixed|string
     */
    public function findWithUserName(int $limit = 100): mixed
    {
        $qb = $this->createQueryBuilder('u');

        return $qb
            //->select('u.id')
            ->innerJoin(MatchUserScoreboard::class, 'mus', Join::WITH, 'u.id = mus.user')
            ->where($qb->expr()->isNotNull('u.steamusername'))
            ->addOrderBy('u.timecreated', 'DESC')
            ->addGroupBy('u.id')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

    }

    public function findNotSynced(int $limit = 10): mixed
    {
        $qb = $this->createQueryBuilder('u');

        return $qb
            ->select('u.steamId')
            ->where($qb->expr()->isNull('u.steamusername'))
            ->addOrderBy('u.timecreated', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

    }

    public function getUserAvgValues()
    {
        $qb = $this->createQueryBuilder('u');

        return $qb
            ->select(
                'AVG(mus.kd) as kd',
                'AVG(mus.adr) as adr',
                'AVG(mus.hspercent) as hspercent',
                'AVG(mus.hltvrating) as hltvrating',
                'AVG(mus.kills) as kills',
                'AVG(mus.mvps) as mvps',
                'AVG(mus.deaths) as deaths',
                'AVG(mus.assists) as assists',
            )
            ->innerJoin(MatchUserScoreboard::class, 'mus', Join::WITH, 'mus.user = u.id')
            ->getQuery()
            ->getResult();
    }

    public function getInventory(User $user)
    {
        $qb = $this->createQueryBuilder('u');

        return $qb
            ->select('skin')
            ->innerJoin(UserSkin::class, 'userskin', Join::WITH, 'userskin.User = u.id')
            ->innerJoin(Skin::class, 'skin', Join::WITH, 'skin.id = userskin.Skin')
            ->where('u.id = :user')
            ->setParameters([':user' => $user->getId()])
            ->getQuery()
            ->getResult();
    }

    public function findWithInventory()
    {
        $qb = $this->createQueryBuilder('u');

        return $qb
            ->select(
                'u.id, u.avatar, u.steamusername, u.steamId, u.profileurl, u.vacbanned, u.owbanned, SUM(skin.lowestPrice) as inventoryWorth'
            )
            ->innerJoin(UserSkin::class, 'userskin', Join::WITH, 'userskin.User = u.id')
            ->innerJoin(Skin::class, 'skin', Join::WITH, 'skin.id = userskin.Skin')
            ->addGroupBy('u.id')
            ->orderBy('inventoryWorth', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
