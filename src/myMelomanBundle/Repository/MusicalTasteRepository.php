<?php

namespace myMelomanBundle\Repository;

use Doctrine\ORM\EntityRepository;
use myDomain\MusicalTasteInterface;

class MusicalTasteRepository extends EntityRepository implements MusicalTasteInterface
{
    public function create($taste)
    {
        $this->getEntityManager()->persist($taste);
    }

    public function remove($taste)
    {
        $this->getEntityManager()->remove($taste);
    }

}