<?php

namespace myMelomanBundle\Repository;

use Doctrine\ORM\EntityRepository;
use myDomain\LikesRepositoryInterface;

class LikesRepository extends EntityRepository implements LikesRepositoryInterface
{
    public function create($like)
    {
        $this->getEntityManager()->persist($like);
    }

    public function remove($like)
    {
        $this->getEntityManager()->remove($like);
    }

    public function countPublicationLikes($pubId)
    {
        $qb = $this->createQueryBuilder('likes');
        $query = $qb->select('likes.id')
            ->where(
                $qb->expr()->eq('likes.publication',':pubId')
            )->setParameter('pubId', $pubId);

        $result = $query->getQuery()->getResult();

        return count($result);
    }

}