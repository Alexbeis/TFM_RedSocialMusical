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
        $user->setMusicalTaste($this->getCurrentTastes($user, $userProfile->getTastes()));
        $this->userRepository->update($user);
        $this->entityManager->flush($user);

        return $user;

    }

    private function getCurrentTastes($user, $rawTastes)
    {
        $tastes = [];

        foreach ($rawTastes as $rawTaste) {
            $taste =  new MusicalTaste();
            $taste->setName($rawTaste);
            if (in_array($taste,$user->getMusicalTaste())) continue;

            $this->entityManager->persist($taste);
            $tastes[] = $taste;
        }
        $this->entityManager->flush();
        return $tastes;
    }

}