<?php

namespace myMelomanBundle\Repository;

use Doctrine\ORM\EntityRepository;
use myDomain\Entity\Notification;
use myDomain\NotificationRepositoryInterface;


class NotificationRepository extends EntityRepository implements NotificationRepositoryInterface
{
    public function create(Notification $notification)
    {
        $this->getEntityManager()->persist($notification);
    }

    public function remove(Notification $notification)
    {
       $this->getEntityManager()->remove($notification);
    }

}