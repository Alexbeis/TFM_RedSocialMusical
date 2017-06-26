<?php


namespace myDomain\UseCases\UserProfile;

use myDomain\Entity\User;
use myDomain\Entity\UserProfile;
use myDomain\UserProfileRepositoryInterface;
use myDomain\UserRepositoryInterface;

class ShowEditUserProfileUseCase
{

    private $userRepository;


    function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute($userId)
    {
        /**
         * @var User $user
         */
        $user = $this->userRepository->find($userId);

        if ($user) {
            return $user;
        }
        else return false;

    }

}