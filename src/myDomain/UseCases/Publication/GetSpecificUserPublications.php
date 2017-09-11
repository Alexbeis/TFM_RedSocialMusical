<?php

namespace myDomain\UseCases\Publication;

use myDomain\PublicationRepositoryInterface;
use myDomain\UserRepositoryInterface;

class GetSpecificUserPublications
{
    private $publicationRepository;
    private $userRepository;
    private $entityManager;

    public function __construct(
        PublicationRepositoryInterface $publicationRepository,
        UserRepositoryInterface $userRepository)
    {
        $this->publicationRepository    = $publicationRepository;
        $this->userRepository           = $userRepository;
    }

    public function execute($id)
    {
        $user    = $this->userRepository->findOneBy(
            array(
                'id' => $id
            )
        );
        $result  = $this->publicationRepository->findBy(
            array(
                'user' => $user
            ),
            array(
                'id' => 'DESC'
            )
        );

        return $result;

    }
}