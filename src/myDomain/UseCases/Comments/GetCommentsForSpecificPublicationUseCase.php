<?php

namespace myDomain\UseCases\Comments;

use myDomain\CommentsRepositoryInterface;
use myDomain\PublicationRepositoryInterface;
use myMelomanBundle\Repository\CommentsRepository;
use myMelomanBundle\Repository\PublicationRepository;

class GetCommentsForSpecificPublicationUseCase
{
    /**
     * @var CommentsRepository
     */
    private $commentsRepository;

    /**
     * @var PublicationRepository
     */
    private $publicationRepository;

    public function __construct(CommentsRepositoryInterface $commentsRepository,
                                PublicationRepositoryInterface $publicationRepository)
    {
        $this->commentsRepository       = $commentsRepository;
        $this->publicationRepository    = $publicationRepository;
    }

    public function execute(int $publicationId)
    {
        $publication    = $this->publicationRepository->find($publicationId);
        $comments       = $this->commentsRepository->findBy(
            array(
                'publication' => $publication
            ),
            array('id' => 'DESC')
        );

        return $comments;

    }

}