<?php

namespace myMelomanBundle\Comments;

use Doctrine\ORM\EntityManagerInterface;
use myDomain\DTO\CommentDTO;
use myDomain\Entity\Comments;
use myDomain\Entity\Publication;
use myDomain\UseCases\Comments\CreateCommentUseCase;
use myMelomanBundle\Repository\CommentsRepository;
use myMelomanBundle\Repository\PublicationRepository;

class CreateCommentsUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CreateCommentUseCase
     */
    private $createCommentUseCase;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $commentsRepositoryMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $publicationRepositoryMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $aEntityMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $publicationMock;

    /**
     * @var CommentDTO
     */
    private $commentDTO;

    protected function setUp()
    {
        $this->aEntityMock = $this->createMock(EntityManagerInterface::class);
        $this->commentsRepositoryMock = $this->createMock(CommentsRepository::class);
        $this->publicationRepositoryMock = $this->createMock(PublicationRepository::class);
        $this->publicationMock = $this->createMock(Publication::class);
        $this->createCommentUseCase = new CreateCommentUseCase(
            $this->commentsRepositoryMock,
            $this->publicationRepositoryMock,
            $this->aEntityMock);
        $this->commentDTO = new CommentDTO(2, 45, 'message');

    }

    protected function tearDown()
    {
        $this->commentsRepositoryMock = null;
        $this->publicationRepositoryMock = null;
        $this->aEntityMock = null;
    }

    /** @test */
    public function dummyTest()
    {
        $this->createCommentUseCase;
    }

    /** @test */
    public function shouldCreateACommentOneTime()
    {
        $this->givenACommentRepositoryThatDoesNotHaveASpecificComment();
        $this->thenThePublicationRepositoryShouldFindAPublication();
        $this->thenTheCommentShouldBeSavedOnce();
        $this->whenTheCreateCommentUseCaseIsExecutedWithASpecificParameters();

    }
    private function givenACommentRepositoryThatDoesNotHaveASpecificComment()
    {
        $this->commentsRepositoryMock
            ->method('find')
            ->willReturn(false);
    }

    private function thenThePublicationRepositoryShouldFindAPublication()
    {
        $this->publicationRepositoryMock
            ->expects($this->once())
            ->method('find')
            ->willReturn($this->publicationMock);
    }

    private function thenTheCommentShouldBeSavedOnce()
    {
        $this->commentsRepositoryMock
            ->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(Comments::class));
    }
    private function whenTheCreateCommentUseCaseIsExecutedWithASpecificParameters()
    {
        $this->createCommentUseCase->execute($this->commentDTO);
    }
}