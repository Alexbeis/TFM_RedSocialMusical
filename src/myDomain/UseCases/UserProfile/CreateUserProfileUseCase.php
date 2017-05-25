<?php

namespace myDomain\UseCases\UserProfile;

use Doctrine\ORM\EntityManagerInterface;
use myDomain\DTO\UserProfileDTO;
use myDomain\Entity\MusicalTaste;
use myDomain\Entity\User;
use myDomain\Entity\UserProfile;
use myDomain\UseCases\User\UpdateUserUseCase;
use myDomain\UserProfileRepositoryInterface;
use myDomain\UserRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CreateUserProfileUseCase
{

    private $userRepository;
    private $userProfileRepository;
    private $updateUserUseCase;
    private $entityManager;
    private $dispatcher;

    public function __construct(

        UserRepositoryInterface $userRepository,
        UserProfileRepositoryInterface $userProfileRepository,
        UpdateUserUseCase $updateUserUseCase,
        EntityManagerInterface $entityManager,
        EventDispatcherInterface $eventDispatcher)
    {
        $this->userRepository           = $userRepository;
        $this->userProfileRepository    = $userProfileRepository;
        $this->updateUserUseCase        = $updateUserUseCase;
        $this->entityManager            = $entityManager;
        $this->dispatcher               = $eventDispatcher;
    }

    public function execute(UserProfileDTO $userProfileDTO)
    {
        /**
         * @var User $user
         */
        $user = $this->userRepository->find($userProfileDTO->getUser());
        if ($user) {
            if($user->getUserProfile() == null) {
                $userProfile = new UserProfile();
            } else {
                $userProfile = $user->getUserProfile();
            }

            $userProfile->setAboutMe($userProfileDTO->getAboutMe());
            $userProfile->setBirthDate(new \DateTime($userProfileDTO->getBirth()));
            $userProfile->setImage($userProfileDTO->getPicture());
            $userProfile->setMusicalTaste($this->getCurrentTastes($userProfileDTO->getTastes()));

            $this->userProfileRepository->create($userProfile);


            $user->setUserProfile($userProfile);

            $this->updateUserUseCase->execute($user);
            $this->entityManager->flush();
            die();

        }
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