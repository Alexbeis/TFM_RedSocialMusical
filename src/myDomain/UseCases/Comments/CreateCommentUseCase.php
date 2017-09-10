<?php

namespace myDomain\UseCases\Comments;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use myDomain\CommentsRepositoryInterface;
use myDomain\DTO\CommentDTO;
use myDomain\Entity\Comments;
use myMelomanBundle\Repository\CommentsRepository;
use myMelomanBundle\Repository\PublicationRepository;

class CreateCommentUseCase
{
    /**
     * @var CommentsRepository
     */
    private $commentsRespoitory;

    /**
     * @var PublicationRepository
     */
    private $publicationRepository;

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(CommentsRepositoryInterface $commentsRepository,
                                PublicationRepository $publicationRepository,
                                EntityManagerInterface $entityManager
    ) {
        $this->commentsRespoitory       = $commentsRepository;
        $this->publicationRepository    = $publicationRepository;
        $this->entityManager            = $entityManager;
    }

    public function execute(CommentDTO $commentDTO)
    {
        if (!$commentDTO->getMessage()) {
            $commentDTO->setResult(false);
            return $commentDTO;
        }

        try {
            $publication = $this->publicationRepository->find($commentDTO->getPublicationId());
            //\Doctrine\Common\Util\Debug::dump($publication);
            $comment = new Comments();
            $comment->setUser($commentDTO->getUserId());
            $comment->setMessage($commentDTO->getMessage());
            $comment->setPublication($publication);

            $this->commentsRespoitory->create($comment);
            $this->entityManager->flush();

            $commentDTO->setResult(true);
            return $commentDTO;
        } catch (\Exception $e) {
            var_dump($e->getMessage());

        }

    }
}