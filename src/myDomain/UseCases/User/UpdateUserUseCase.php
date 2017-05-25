<?php

namespace myDomain\UseCases\User;


use Doctrine\ORM\EntityManagerInterface;
use myDomain\Entity\User;
use myDomain\UserRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class UpdateUserUseCase
{
    private $userRepository;
    private $entityManager;
    private $dispatcher;

    public function __construct(UserRepositoryInterface $userRepository,
                                EntityManagerInterface $entityManager,
                                EventDispatcherInterface $dispatcher)
    {
        $this->userRepository = $userRepository;
        $this->entityManager  = $entityManager;
        $this->dispatcher     = $dispatcher;
    }

    public function execute(User $user)
    {
        $this->userRepository->update($user);

    }

}