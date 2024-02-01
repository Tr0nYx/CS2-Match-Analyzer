<?php

namespace App\Repository;

use App\Entity\Skin;
use App\Entity\User;
use App\Entity\UserSkin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserSkin>
 *
 * @method UserSkin|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserSkin|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserSkin[]    findAll()
 * @method UserSkin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserSkinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserSkin::class);
    }

    public function getCount()
    {
        $qb = $this->createQueryBuilder('u');

        return $qb
            ->select('COUNT(user) as skins,SUM(skin.lowestPrice) as inventoryValue')
            ->innerJoin(Skin::class, 'skin', Join::WITH, 'u.Skin = skin.id')
            ->innerJoin(User::class, 'user', Join::WITH, 'user.id = u.User')
            ->groupBy('user.id')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return UserSkin[] Returns an array of UserSkin objects
     */
    public function findByUser(User $user): array
    {
        return $this->createQueryBuilder('u')
            ->select('s')
            ->innerJoin(Skin::class, 's', Join::WITH, 'u.Skin = s.id')
            ->andWhere('u.User = :val')
            ->addOrderBy('s.lowestPrice', 'DESC')
            ->setParameter('val', $user->getId())
            ->getQuery()
            ->getResult();
    }

    public function findOneUserAndSkin(User $user, Skin $skin): ?UserSkin
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.User = :user')
            ->andWhere('u.Skin = :skin')
            ->setParameters(['user' => $user->getId(), 'skin' => $skin->getId()])
            ->getQuery()
            ->getOneOrNullResult();
    }
}
