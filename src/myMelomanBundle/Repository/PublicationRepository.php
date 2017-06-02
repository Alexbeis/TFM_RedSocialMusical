<?php

namespace myMelomanBundle\Repository;

use Doctrine\ORM\EntityRepository;
use myDomain\PublicationRepositoryInterface;

class PublicationRepository extends EntityRepository implements PublicationRepositoryInterface
{
    public function create($publication)
    {
       $this->getEntityManager()->persist($publication);
    }

    public function update($publication)
    {
        // TODO: Implement update() method.
    }

    public function remove($publication)
    {
        // TODO: Implement remove() method.
    }


}