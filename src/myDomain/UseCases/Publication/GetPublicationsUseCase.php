<?php

namespace myDomain\UseCases\Publication;


use Doctrine\ORM\EntityManagerInterface;
use myMelomanBundle\Repository\PublicationRepository;

class GetPublicationsUseCase
{
    private $publicationRepository;
    private $entityManager;

    public function __construct(
        PublicationRepository $publicationRepository,
        EntityManagerInterface $entityManager)
    {
        $this->publicationRepository    = $publicationRepository;
        $this->entityManager            = $entityManager;

    }

    public function execute($id)
    {
        $publications  = $this-> publicationRepository->findby(array('user' => $id));

        return $publications;


    }


}