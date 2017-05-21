<?php

namespace myDomain\UseCases\UserProfile;

use Doctrine\ORM\EntityManagerInterface;
use myDomain\DTO\UserProfileDTO;
use myDomain\UserProfileRepositoryInterface;
use myDomain\UserRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CreateUserProfileUseCase
{
    private $userRepository;
    private $userProfileRepository;
    private $entityManager;
    private $dispatcher;

    public function __construct(

        UserRepositoryInterface $userRepository,
        UserProfileRepositoryInterface $userProfileRepository,
        EntityManagerInterface $entityManager,
        EventDispatcherInterface $eventDispatcher)
    {
        $this->userRepository           = $userRepository;
        $this->userProfileRepository    = $userProfileRepository;
        $this->entityManager            = $entityManager;
        $this->dispatcher               = $eventDispatcher;
    }

    public function execute(UserProfileDTO $userProfileDTO)
    {
        var_dump($userProfileDTO);
        die();

    }

}