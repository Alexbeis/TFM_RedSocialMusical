<?php

namespace myDomain\UseCases\Notification;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManagerInterface;
use myDomain\Entity\Notification;
use myDomain\NotificationRepositoryInterface;
use myDomain\UserRepositoryInterface;

class MarkNotificationsAsRead
{
    /**
     * @var Registry
     */
    private $notificationRepository;

    private $entityManager;

    public function __construct( NotificationRepositoryInterface $notificationRepository,
                                 EntityManagerInterface $entityManager)
    {
        $this->notificationRepository = $notificationRepository;
        $this->entityManager = $entityManager;
    }

    public function execute($id)
    {
       try{
           /**
            * @var Notification $notification
            */
           $notification = $this->notificationRepository->find($id);
           $notification->setRead(true);
           $this->notificationRepository->remove($notification);
           $this->entityManager->flush();

           return true;

       } catch (\Exception $e) {
            return false;
       }

    }


}