<?php

namespace myDomain\UseCases\Notification;

use Doctrine\ORM\EntityManagerInterface;
use myDomain\Entity\Notification;
use myDomain\NotificationRepositoryInterface;
use myDomain\PublicationRepositoryInterface;
use myDomain\UserRepositoryInterface;
use myMelomanBundle\Repository\NotificationRepository;
use myMelomanBundle\Repository\PublicationRepository;
use myMelomanBundle\Repository\UserRepository;
use Symfony\Component\Config\Definition\Exception\Exception;

class CreateNotificationUseCase
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var NotificationRepository
     */
    private $notificationRepository;

    /**
     * @var PublicationRepository
     */
    private $publicationRepository;

    /**
     * @var $entityManager
     */
    private $entityManager;

    public function __construct(UserRepositoryInterface $userRepository,
                                NotificationRepositoryInterface $notificationRepository,
                                PublicationRepositoryInterface $publicationRepository,
                                EntityManagerInterface $entityManager
    ) {
        $this->userRepository           = $userRepository;
        $this->notificationRepository   = $notificationRepository;
        $this->publicationRepository    = $publicationRepository;
        $this->entityManager            = $entityManager;
    }


    public function execute($id, $type, $userGeneratedId, $extra = null)
    {
        try {
//            $user = $this->userRepository->find($userId);/
            /**
             * Publication $publication
             */
            if ($type == 'like') {
                $publication = $this->publicationRepository->find($id);
                $userTo  = $this->userRepository->find($publication->getUser());
                $extra = $publication->getId();
            } elseif ($type == 'follow') {
                $userTo = $this->userRepository->find($id);
            }

            $notification = new Notification();
            // User: A quien va dirigida la notificacion type :Publication/Follow TypeId: User que la ha generado
            $notification->setUser($userTo);
            $notification->setType($type);
            $notification->setUserGenerateId($userGeneratedId);
            $notification->setCreatedAt(new \DateTime('now'));
            $notification->setRead(false);
            $notification->setExtra($extra);

            $this->notificationRepository->create($notification);
            $this->entityManager->flush();

            return true;
        }catch (Exception $e){
            return false;
        }


    }
}