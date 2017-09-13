<?php

namespace myMelomanBundle\Likes;

use Doctrine\ORM\EntityManager;
use myDomain\DTO\LikeDTO;
use myDomain\Entity\Likes;
use myDomain\Entity\Publication;
use myDomain\Entity\User;
use myDomain\UseCases\Like\DislikePublicationUseCase;
use myMelomanBundle\Repository\LikesRepository;
use myMelomanBundle\Repository\PublicationRepository;
use myMelomanBundle\Repository\UserRepository;

class DislikePublicationUseCaseTest extends \PHPUnit_Framework_TestCase
{
    const User = 2;
    const PUB = 15;
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $publicationRepositoryMock;
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $userRepositoryMock;
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $likesRepositoryMock;
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $entityManagerMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $userMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $publicationMock;

    private $likesMock;

    /**
     * @var DislikePublicationUseCase
     */
    private $dislikePublicationUseCase;

    /**
     * @var LikeDTO
     */
    private $likeDTO;

    private $likes;

    protected function setUp()
    {
        $this->publicationRepositoryMock = $this->createMock(PublicationRepository::class);
        $this->userRepositoryMock = $this->createMock(UserRepository::class);
        $this->likesRepositoryMock = $this->createMock(LikesRepository::class);
        $this->entityManagerMock = $this->createMock(EntityManager::class);
        $this->userMock = $this->createMock(User::class);
        $this->publicationMock = $this->createMock(Publication::class);
        $this->likesMock = $this->createMock(Likes::class);
        $this->likeDTO = new LikeDTO(self::User, self::PUB);
        $this->dislikePublicationUseCase = new DislikePublicationUseCase(
            $this->publicationRepositoryMock,
            $this->userRepositoryMock,
            $this->likesRepositoryMock,
            $this->entityManagerMock
        );
        $this->likes = new Likes();
    }

    protected function tearDown()
    {
        $this->publicationRepositoryMock = null;
        $this->userRepositoryMock = null;
        $this->likesRepositoryMock = null;
        $this->entityManagerMock = null;
        $this->userMock = null;
        $this->publicationMock = null;
        $this->likesMock = null;
    }

    /** @test */
    public function dummyTest()
    {
        $this->dislikePublicationUseCase;
    }

    /** @test */
    public function shouldRemoveALikeOneTimeIfItExist()
    {
        $this->givenALikeRepositoryThatHasASpecificLike();
        $this->andGivenAUserRepositoryThatHaveASpecifiUser();
        $this->andGivenAPublicationRepositoryThatHaveASpecificPublication();
        $this->thenTheLikeShouldBeRemovedOnce();
        $this->whenTheDislikePublicationUseCaseIsExecutedWithASpecificParameters();
    }

    private function givenALikeRepositoryThatHasASpecificLike()
    {
        $this->likesRepositoryMock
            ->method('findOneBy')
            ->willReturn($this->likesMock);
    }
    private function andGivenAUserRepositoryThatHaveASpecifiUser()
    {
        $this->userRepositoryMock
            ->method('find')
            ->willReturn($this->userMock);
    }

    private function andGivenAPublicationRepositoryThatHaveASpecificPublication()
    {
        $this->publicationRepositoryMock
            ->method('find')
            ->willReturn($this->publicationMock);
    }

    private function thenTheLikeShouldBeRemovedOnce()
    {
        $this->likesRepositoryMock
            ->expects($this->once())
            ->method('remove')
            ->with($this->isInstanceOf(Likes::class));
    }

    private function whenTheDislikePublicationUseCaseIsExecutedWithASpecificParameters()
    {
        $this->dislikePublicationUseCase->execute($this->likeDTO);
    }


}