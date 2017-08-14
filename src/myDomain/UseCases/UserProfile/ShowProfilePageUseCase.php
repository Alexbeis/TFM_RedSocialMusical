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
        $publications = $this->publicationRepository->findBy(array('user' => $user),array('id' => 'DESC'));


        if ($user) {
            return $returnArray = array('user' => $user, 'publications' => $publications);
        }
        else return false;

    }

}