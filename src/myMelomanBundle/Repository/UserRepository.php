<?php

namespace myMelomanBundle\Repository;

use Doctrine\ORM\EntityRepository;
use myDomain\UserRepositoryInterface;

class UserRepository extends EntityRepository implements userRepositoryInterface
{
    public function create($user)
    {
        $this->getEntityManager()->persist($user);
    }

    public function remove($user)
    {
        $this->getEntityManager()->remove($user);
    }

}
