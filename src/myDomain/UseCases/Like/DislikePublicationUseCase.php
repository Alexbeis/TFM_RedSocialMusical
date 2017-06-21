<?php

namespace myDomain\UseCases\Like;

use Doctrine\ORM\EntityManagerInterface;
use myDomain\DTO\LikeDTO;
use myDomain\Entity\Likes;
use myDomain\LikesRepositoryInterface;
use myDomain\PublicationRepositoryInterface;
use myDomain\UserRepositoryInterface;


class DislikePublicationUseCase
{
    private $publicationRepository;
    private $userRepository;
    private $likesRepository;
    private $entityManager;

    public function __construct (
        PublicationRepositoryInterface $publicationRepository,
        UserRepositoryInterface $userRepository,
        LikesRepositoryInterface $likesRepository,
        EntityManagerInterface $entityManager
    )
    {
        $this->publicationRepository    = $publicationRepository;
        $this->userRepository           = $userRepository;
        $this->likesRepository          = $likesRepository;
        $this->entityManager            = $entityManager;
    }

    public function execute(LikeDTO $likeDTO)
    {
        try {

            $user           = $this->userRepository->find($likeDTO->getUserId());
            $publication    = $this->publicationRepository->find($likeDTO->getPublicationId());

            $like = $this->likesRepository->findOneBy(
                array(
                    'user' => $user,
                    'publication' => $publication
                )
            );
            $this->likesRepository->remove($like);

            return true;

        } catch (\Exception $e) {
            return false;
        }
    }


}