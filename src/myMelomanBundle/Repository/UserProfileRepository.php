<?php

namespace myMelomanBundle\Repository;

use Doctrine\ORM\EntityRepository;
use myDomain\UserProfileRepositoryInterface;


class UserProfileRepository extends EntityRepository implements UserProfileRepositoryInterface
{
    public function create($userProfile)
    {
        $this->getEntityManager()->persist($userProfile);
    }

    public function remove($userProfile)
    {
        $this->getEntityManager()->remove($userProfile);
    }
}
