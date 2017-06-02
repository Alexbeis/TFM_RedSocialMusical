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

    public function update($user)
    {
       $this->getEntityManager()->persist($user);
    }

    public function remove($user)
    {
        $this->getEntityManager()->remove($user);
    }

    public function getQuery()
    {
        $dql = "SELECT u FROM myDomain\Entity\User u ORDER BY u.id";
        $query = $this->getEntityManager()->createQuery($dql);

        return $query;

    }

}
