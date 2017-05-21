<?php

namespace myDomain\UseCases\User;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use myDomain\Entity\User;
use myDomain\UserRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CreateUserUseCase
{

    private $userRepository;
    private $entityManager;
    private $eventDispatcher;

    public function __construct(
        userRepositoryInterface $userRepository,
        EntityManagerInterface $entityManager,
        EventDispatcherInterface $eventDispatcher)
    {
        $this->userRepository   = $userRepository;
        $this->entityManager    = $entityManager;
        $this->eventDispatcher  = $eventDispatcher;
    }

    public function execute($name, $email)
    {
        $user = new User();
        $user->setEmail($email);
        $user->setJoinDate(new \DateTime('now'));
        $user->setUsername($name);

        //$this->entityManager->persist($user);
        $this->userRepository->create($user);
        $this->entityManager->flush();

        return $user;

    }

}