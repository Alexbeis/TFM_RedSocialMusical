<?php

namespace myMelomanBundle\Likes;

use Doctrine\ORM\EntityManager;
use myDomain\DTO\LikeDTO;
use myDomain\Entity\Likes;
use myDomain\Entity\Publication;
use myDomain\Entity\User;
use myDomain\UseCases\Like\LikePublicationUseCase;
use myMelomanBundle\Repository\LikesRepository;
use myMelomanBundle\Repository\PublicationRepository;
use myMelomanBundle\Repository\UserRepository;

class LikePublicationUseCaseTest extends \PHPUnit_Framework_TestCase
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

    /**
     * @var LikePublicationUseCase
     */
    private $likePublicationUseCase;

    /**
     * @var LikeDTO
     */
    private $likeDTO;

    protected function setUp()
    {
        $this->publicationRepositoryMock = $this->createMock(PublicationRepository::class);
        $this->userRepositoryMock = $this->createMock(UserRepository::class);
        $this->likesRepositoryMock = $this->createMock(LikesRepository::class);
        $this->entityManagerMock = $this->createMock(EntityManager::class);
        $this->userMock = $this->createMock(User::class);
        $this->publicationMock = $this->createMock(Publication::class);
        $this->likeDTO = new LikeDTO(self::User, self::PUB);
        $this->likePublicationUseCase = new LikePublicationUseCase(
            $this->publicationRepositoryMock,
            $this->userRepositoryMock,
            $this->likesRepositoryMock,
            $this->entityManagerMock
        );
    }

    protected function tearDown()
    {
        $this->publicationRepositoryMock = null;
        $this->userRepositoryMock = null;
        $this->likesRepositoryMock = null;
        $this->entityManagerMock = null;
        $this->userMock = null;
        $this->publicationMock = null;
    }

    /** @test */
    public function dummyTest()
    {
        $this->likePublicationUseCase;
    }

    /** @test */
    public function shouldCreateALikeOneTimeIfItDoesNotExist()
    {
        $this->givenALikeRepositoryThatDoesNotHaveASpecificLike();
        $this->andGivenAUserRepositoryThatHaveASpecifiUser();
        $this->andGivenAPublicationRepositoryThatHaveASpecificPublication();
        $this->thenTheLikeShouldBeSavedOnce();
        $this->whenTheLikePublicationUseCaseIsExecutedWithASpecificParameters();
    }

    private function givenALikeRepositoryThatDoesNotHaveASpecificLike()
    {
        $this->likesRepositoryMock
            ->method('findOneBy')
            ->willReturn(false);
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

    private function thenTheLikeShouldBeSavedOnce()
    {
        $this->likesRepositoryMock
            ->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(Likes::class));
    }

    private function whenTheLikePublicationUseCaseIsExecutedWithASpecificParameters()
    {
        $this->likePublicationUseCase->execute($this->likeDTO);
    }

}