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
        $this->getEntityManager()->remove($publication);
    }

    public function findMeAndFriendPublications($userId, $myFollows)
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.user = (:user_id) OR p.user IN (:following)')
            ->setParameters(
                array(
                    'user_id' => $userId,
                    'following' => $myFollows
                )
            )
            ->orderBy('p.id', 'DESC')
            ->getQuery()->getResult();
        
        return $query;
    }

}