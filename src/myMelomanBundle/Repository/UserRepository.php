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

    public function getAllUsersQuery()
    {
        $dql = "SELECT u FROM myDomain\Entity\User u ORDER BY u.id";
        $query = $this->getEntityManager()->createQuery($dql);

        return $query;

    }

    public function getSearchQuery($search)
    {
        $dql = "SELECT u FROM myDomain\Entity\User u "
                . "WHERE u.username like :search or u.email like :search "
                . "ORDER BY u.id";
        $query = $this->getEntityManager()->createQuery($dql)->setParameter('search', "%$search%");

        return $query;

    }

}
