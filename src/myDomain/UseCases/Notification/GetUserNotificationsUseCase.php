<?php

namespace myDomain\UseCases\Notification;

use myDomain\NotificationRepositoryInterface;
use myDomain\UserRepositoryInterface;
use myMelomanBundle\Repository\NotificationRepository;
use myMelomanBundle\Repository\UserRepository;

class GetUserNotificationsUseCase
{
    /**
     * @var NotificationRepository
     */
    private $notificationRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(NotificationRepositoryInterface $notificationRepository,
                                UserRepositoryInterface $userRepository)
    {
        $this->notificationRepository   = $notificationRepository;
        $this->userRepository           = $userRepository;

    }

    public function execute($userId)
    {
        $user = $this->userRepository->find($userId);
        $notifications = $this->notificationRepository->findBy(
            array(
                'user' => $user,
                'read' => false
            ),
            array('id' => 'DESC')
        );

        return $notifications;

    }
}