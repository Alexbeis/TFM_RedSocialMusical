<?php

namespace myDomain\UseCases\UserProfile;


use myDomain\Entity\User;
use myDomain\PublicationRepositoryInterface;
use myDomain\UserRepositoryInterface;

class ShowProfilePageUseCase
{
    private $userRepository;
    private $publicationRepository;

    public function __construct(UserRepositoryInterface $userRepository,
                                PublicationRepositoryInterface $publicationRepository)
    {
        $this->userRepository           = $userRepository;
        $this->publicationRepository    = $publicationRepository;
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