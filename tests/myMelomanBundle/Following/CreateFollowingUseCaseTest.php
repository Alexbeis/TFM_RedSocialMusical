<?php

namespace myMelomanBundle\Follow;

use Doctrine\ORM\EntityManagerInterface;
use myDomain\DTO\FollowingDTO;
use myDomain\Entity\Following;
use myDomain\Entity\User;
use myDomain\UseCases\Follow\CreateFollowUseCase;
use myMelomanBundle\Repository\FollowingRepository;
use myMelomanBundle\Repository\UserRepository;
use PHPUnit_Framework_MockObject_MockObject;

class CreateFollowingUseCaseTest extends \PHPUnit_Framework_TestCase
{
    const USER = 1;
    const FRIEND = 2;

    /**
     * @var CreateFollowUseCase
     */
    private $createFollowUseCase;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $followRepositoryMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $userRepositoryMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $aEntityMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $userMock;

    /**
     * @var FollowingDTO
     */
    private $followingDTO;


    protected function setUp()
    {

        $this->followRepositoryMock = $this->createMock(FollowingRepository::class);
        $this->userRepositoryMock = $this->createMock(UserRepository::class);
        $this->userMock = $this->createMock(User::class);
        $this->aEntityMock = $this->createMock(EntityManagerInterface::class);
        $this->createFollowUseCase = new CreateFollowUseCase(
            $this->userRepositoryMock,
            $this->aEntityMock,
            $this->followRepositoryMock);
        $this->followingDTO = new FollowingDTO(self::USER, self::FRIEND);

    }

    protected function tearDown()
    {
        $this->followRepositoryMock = null;
        $this->userRepositoryMock = null;
        $this->userMock = null;
        $this->createFollowUseCase = null;
    }

    /** @test */
    public function dummyTest()
    {
        $this->createFollowUseCase;
    }

    /** @test */
    public function shouldCreateAFollowOneTimeIfItDoesNotExist()
    {
        $this->givenAFollowingRepositoryThatDoesNotHaveASpecificFollow();
        $this->andGivenAUserRepositoryThatHaveASpecifiUser();
        $this->thenTheFollowShouldBeSavedOnce();
        $this->whenTheCreateFollowUseCaseIsExecutedWithASpecificParameters();

    }

    /** @test */
    public function shouldNotCreateAFollowIfItAlreadyExists()
    {
        $this->givenAFollowingRepositoryThatHaveASpecificFollow();
        $this->andGivenAUserRepositoryThatHaveASpecifiUser();
        $this->thenTheFollowShouldNotBeSaved();
        $this->whenTheCreateFollowUseCaseIsExecutedWithASpecificParameters();

    }

    private function givenAFollowingRepositoryThatDoesNotHaveASpecificFollow()
    {
        $this->followRepositoryMock
            ->method('findOneBy')
            ->willReturn(false);
    }

    private function givenAFollowingRepositoryThatHaveASpecificFollow()
    {
        $this->followRepositoryMock
            ->method('findOneBy')
            ->willReturn(Following::class);
    }

    private function andGivenAUserRepositoryThatHaveASpecifiUser()
    {
        $this->userRepositoryMock
            ->method('findOneBy')
            ->willReturn($this->userMock);
    }

    private function thenTheFollowShouldBeSavedOnce()
    {
        $this->followRepositoryMock
            ->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(Following::class));
    }

    private function whenTheCreateFollowUseCaseIsExecutedWithASpecificParameters()
    {
        $this->createFollowUseCase->execute($this->followingDTO);
    }

    private function thenTheFollowShouldNotBeSaved()
    {
        $this->followRepositoryMock
            ->expects($this->never())
            ->method('create');

    }
}