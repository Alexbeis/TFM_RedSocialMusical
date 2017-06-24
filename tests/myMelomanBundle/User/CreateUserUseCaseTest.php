<?php

namespace myMelomanBundle\User;


use myDomain\UseCases\User\CreateUserUseCase;
use PHPUnit_Framework_MockObject_MockObject;

class CreateUserUseCaseTest extends \PHPUnit_Framework_TestCase
{
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
    private $createUserMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $userMock;


    protected function setUp()
    {

        $this->userRepositoryMock = $this->createMock(UserRepository::class);
        $this->userMock = $this->createMock(User::class);
        $this->aDispatcherMock = $this->createMock();

        $this->createUserUseCase = new CreateUserUseCase($this->userRepositoryMock, $this->aDispatcherMock);

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
    public function fakeTest()
    {
        try {

            $this->userRepositoryMock->expects($this->once())->method('save');
            $this->createUserUseCase->execute($this->createUserMock);
        } catch (\Exception $e) {

        }
    }

    /** @test */
    public function stubTest()
    {
        $this->expectException(\Exception::class);
        $this->userRepositoryMock->method('save')->willReturn(null);
        $this->createUserUseCase->execute($this->createUserMock);
    }


}