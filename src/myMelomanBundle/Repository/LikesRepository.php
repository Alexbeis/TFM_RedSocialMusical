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

}