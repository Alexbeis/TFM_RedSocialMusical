<?php

namespace myMelomanBundle\Repository;

use Doctrine\ORM\EntityRepository;
use myDomain\CommentsRepositoryInterface;

class CommentsRepository extends EntityRepository implements CommentsRepositoryInterface
{
    public function create($comment)
    {
        $this->getEntityManager()->persist($comment);

    }

}