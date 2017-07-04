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

    public function __construct(
        userRepositoryInterface $userRepository,
        EntityManagerInterface $entityManager)
    {
        $this->userRepository   = $userRepository;
        $this->entityManager    = $entityManager;
    }

    public function execute($name, $email, $picture)
    {
        $user = new User();
        $user->setEmail($email);
        $user->setJoinDate(new \DateTime('now'));
        $user->setUsername($name);
        $user->setImage($picture);

        $this->userRepository->create($user);
        $this->entityManager->flush($user);

        return $user;

    }

}