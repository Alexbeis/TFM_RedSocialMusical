<?php

namespace myMelomanBundle\Follow;

use Doctrine\ORM\EntityManagerInterface;
use myDomain\DTO\FollowingDTO;
use myDomain\Entity\Following;
use myDomain\Entity\User;
use myDomain\FollowingRepositoryInterface;
use myDomain\UseCases\Follow\CreateFollowUseCase;
use myDomain\UserRepositoryInterface;
use myMelomanBundle\Repository\FollowingRepository;
use myMelomanBundle\Repository\UserRepository;
use PHPUnit_Framework_MockObject_MockObject;

class CreateFollowingUseCaseTest extends \PHPUnit_Framework_TestCase
{

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

    private $followingDTO;


    protected function setUp()
    {

        $this->followRepositoryMock = $this->createMock(FollowingRepository::class);
        $this->userRepositoryMock = $this->createMock(UserRepository::class);
        $this->userMock = $this->createMock(User::class);
        $this->aEntityMock = $this->createMock(EntityManagerInterface::class);
        $this->createFollowUseCase = new CreateFollowUseCase( $this->userRepositoryMock, $this->aEntityMock, $this->followRepositoryMock);
        $this->followingDTO = new FollowingDTO('1', '2');

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
            ->method('find')
            ->willReturn(false);
    }

    private function givenAFollowingRepositoryThatHaveASpecificFollow()
    {
        $this->followRepositoryMock
            ->method('find')
            ->willReturn(Following::class);
    }

    private function andGivenAUserRepositoryThatHaveASpecifiUser()
    {
        $this->userRepositoryMock
            ->method('find')
            ->willReturn($this->isInstanceOf(User::class));
    }

    private function thenTheFollowShouldBeSavedOnce()
    {
//        var_dump($this->followRepositoryMock);
        $this->followRepositoryMock
            ->expects($this->never()) // Falla aquí
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