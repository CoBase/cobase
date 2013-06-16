<?php

namespace Cobase\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Cobase\UserBundle\Entity\User;

/**
 * SubscriptionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SubscriptionRepository extends EntityRepository
{
    /**
     * Find group subscriptions for a given user
     *
     * @param \Cobase\UserBundle\Entity\User $user
     * @return array
     */
    public function findAllForUser(User $user)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT s
             FROM Cobase\AppBundle\Entity\Subscription s 
             WHERE s.user = :user ORDER BY s.created ASC'
        )->setParameter('user', $user);

        return $query->getResult();
        
        
        $qb = $this->createQueryBuilder('b')
            ->select('b, c')
            ->leftJoin('b.group', 'c')
            ->addOrderBy('b.created', 'DESC')
            ->andWhere('c.user = ?1')
            ->setParameter('1', $user);

        echo $qb->getQuery()->getDQL(); exit; 
        return $qb->getQuery()
            ->getResult();
    }
}
