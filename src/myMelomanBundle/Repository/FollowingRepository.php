<?php

namespace myMelomanBundle\Repository;

use Doctrine\ORM\EntityRepository;
use myDomain\FollowingRepositoryInterface;

class FollowingRepository extends EntityRepository implements FollowingRepositoryInterface
{
    public function create($following)
    {
        $this->getEntityManager()->persist($following);
    }

    public function delete($following)
    {
        $this->getEntityManager()->remove($following);
    }
}