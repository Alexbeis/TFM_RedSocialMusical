<?php

namespace myDomain\UseCases\Publication;

use Doctrine\ORM\EntityManagerInterface;
use myDomain\PublicationRepositoryInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class DeletePublicationUseCase
{
    private $publicationRepository;
    private $entityManager;

    public function __construct(
        PublicationRepositoryInterface $publicationRepository,
        EntityManagerInterface $entityManager)
    {
        $this->publicationRepository = $publicationRepository;
        $this->entityManager = $entityManager;
    }

    public function execute(int $userId, int $pubId)
    {
        try {
            $publication = $this->publicationRepository->find($pubId);
            if ($publication->getUser()->getId() == $userId) {
                $this->publicationRepository->remove($publication);
                $this->entityManager->flush();

                return true;
            }

        } catch (Exception $e) {
            return false;
        }

    }

}