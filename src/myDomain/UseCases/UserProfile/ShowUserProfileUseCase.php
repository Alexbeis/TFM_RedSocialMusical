<?php


namespace myDomain\UseCases\UserProfile;

use myDomain\Entity\User;
use myDomain\Entity\UserProfile;
use myDomain\UserProfileRepositoryInterface;
use myDomain\UserRepositoryInterface;

class ShowUserProfileUseCase
{

    private $userRepository;
    private $userProfileRepository;


    function __construct(UserRepositoryInterface $userRepository, UserProfileRepositoryInterface $userProfileRepository)
    {
        $this->userRepository = $userRepository;
        $this->userProfileRepository = $userProfileRepository;
    }

    public function execute($userId)
    {
        /**
         * @var User $user
         */
        $user = $this->userRepository->find($userId);

        if ($user->getUserProfile() == null) {
            return new UserProfile();
        } else {
            return $user->getUserProfile();
        }


    }

}