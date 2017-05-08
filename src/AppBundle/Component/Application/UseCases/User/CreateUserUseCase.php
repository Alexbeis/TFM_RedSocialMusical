<?php

namespace AppBundle\Component\Application\UseCases\User;

use AppBundle\Component\Domain\Entity\User;

class CreateUserUseCase
{

    private $userRepository;
    private $entityManager;
    private $eventDispatcher;

    public function __construct($userRepository, $entityManager, $eventDispatcher)
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

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;

    }

}