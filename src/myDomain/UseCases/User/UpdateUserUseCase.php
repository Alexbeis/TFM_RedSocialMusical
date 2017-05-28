<?php

namespace myDomain\UseCases\User;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManagerInterface;
use myDomain\DTO\UserProfileDTO;
use myDomain\Entity\MusicalTaste;
use myDomain\Entity\User;
use myDomain\UserRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class UpdateUserUseCase
{
    /**
     * @var Registry
     */
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

    public function execute($userId, UserProfileDTO $userProfile)
    {
        /**
         * @var User $user
         */
        $user = $this->userRepository->findOneBy(array('id' => $userId));
        $user->setAboutMe($userProfile->getAboutMe());
        $user->setBirthDate($userProfile->getBirth());
        $user->setMusicalTaste($this->getCurrentTastes($userProfile->getTastes()));
        $this->userRepository->update($user);
        $this->entityManager->flush();

        return $user;

    }

    private function getCurrentTastes($rawTastes)
    {
        $tastes = [];

        foreach ($rawTastes as $rawTaste) {
            $taste =  new MusicalTaste();
            $taste->setName($rawTaste);
            $tastes[] = $taste;
        }
        return $tastes;
    }

}