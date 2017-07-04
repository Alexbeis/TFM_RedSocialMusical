<?php

namespace myMelomanBundle\User;


use Doctrine\ORM\EntityManagerInterface;
use myDomain\Entity\User;
use myDomain\UseCases\User\CreateUserUseCase;
use myMelomanBundle\Repository\UserRepository;
use PHPUnit_Framework_MockObject_MockObject;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CreateUserUseCaseTest extends \PHPUnit_Framework_TestCase
{
    const NAME      = "me";
    const EMAIL     = "email";
    const PICTURE   = "https://link_to_picture";

    /**
     * @var CreateUserUseCase
     */
    private $createUserUseCase;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $userRepositoryMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $aDispatcherMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $aEntityMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $userMock;


    protected function setUp()
    {

        $this->userRepositoryMock = $this->createMock(UserRepository::class);
        $this->userMock = $this->createMock(User::class);
        $this->aDispatcherMock = $this->createMock(EventDispatcherInterface::class);
        $this->aEntityMock = $this->createMock(EntityManagerInterface::class);
        $this->createUserUseCase = new CreateUserUseCase($this->userRepositoryMock, $this->aEntityMock ,$this->aDispatcherMock);

    }

    protected function tearDown()
    {
        $this->userRepositoryMock = null;
        $this->aDependencyMock = null;
        $this->createUserMock = null;
        $this->userMock = null;

        $this->createUserUseCase = null;
    }

    /** @test */
    public function dummyTest()
    {
        $this->createUserUseCase;
    }

    /** @test */
    public function shouldCreateAUserOneTimeIfItDoesNotExist()
    {
        $this->givenAUserRepositoryThatDoesNotHaveASpecificUser();
        $this->thenTheUserShouldBeSavedOnce();
        $this->whenTheCreateUserUseCaseIsExecutedWithASpecificParameters();

    }

    /** @test */
    public function shouldNotCreateAUserIfItAlreadyExists()
    {
        $this->givenAUserRepositoryThatHasASpecificUser();
        $this->thenTheUserShouldNotBeCreated();

    }

    private function givenAUserRepositoryThatDoesNotHaveASpecificUser()
    {
        $this->userRepositoryMock
            ->method('find')
            ->willReturn(false);
    }

    private function thenTheUserShouldBeSavedOnce()
    {
        $this->userRepositoryMock
            ->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(User::class));
    }

    private function whenTheCreateUserUseCaseIsExecutedWithASpecificParameters()
    {
        $this->createUserUseCase->execute(self::NAME , self::EMAIL, self::PICTURE);
    }

    private function givenAUserRepositoryThatHasASpecificUser()
    {
        $this->userRepositoryMock
            ->method('find')
            ->willReturn($this->isInstanceOf(User::class));

    }

    private function thenTheUserShouldNotBeCreated()
    {
        $this->userRepositoryMock
            ->expects($this->never())
            ->method('create');
    }

}