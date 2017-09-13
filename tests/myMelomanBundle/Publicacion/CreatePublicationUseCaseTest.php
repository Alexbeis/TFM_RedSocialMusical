<?php

namespace myMelomanBundle\Publication;

use myDomain\Entity\Publication;
use myDomain\UseCases\Publication\CreatePublicationUseCase;
use myMelomanBundle\Repository\UserRepository;
use myMelomanBundle\Repository\PublicationRepository;
use PHPUnit_Framework_MockObject_MockObject;
use Doctrine\ORM\EntityManagerInterface;
use myDomain\Entity\User;

class CreatePublicationUseCaseTest extends \PHPUnit_Framework_TestCase
{
    const USER_ID   = 2;
    const MESSAGE   = "message";
    const URI       = "spotify:uri:47n4in3482nk";

    /**
     * @var CreatePublicationUseCase
     */
    private $createPublicationUseCase;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $userRepositoryMock;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $publicationRepositoryMock;

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
        $this->publicationRepositoryMock = $this->createMock(PublicationRepository::class);
        $this->aEntityMock = $this->createMock(EntityManagerInterface::class);
        $this->createPublicationUseCase = new CreatePublicationUseCase($this->publicationRepositoryMock, $this->userRepositoryMock, $this->aEntityMock);
        $this->userMock = $this->createMock(User::class);

    }

    protected function tearDown()
    {
        $this->userRepositoryMock = null;
        $this->publicationRepositoryMock = null;
        $this->createPublicationUseCase = null;
        $this->userMock = null;
    }

    /** @test */
    public function dummyTest()
    {
        $this->createPublicationUseCase;
    }

    /** @test */
    public function shouldCreateAPublicationOneTimeIfItDoesNotExist()
    {
        $this->givenAPublicationRepositoryThatDoesNotHaveASpecificPublication();
        $this->thenTheUserRepositoryShouldFindAUser();
        $this->thenThePublicationShouldBeSavedOnce();
        $this->whenTheCreateUserUseCaseIsExecutedWithASpecificParameters();

    }

    private function givenAPublicationRepositoryThatDoesNotHaveASpecificPublication()
    {
        $this->publicationRepositoryMock
            ->method('find')
            ->willReturn(false);
    }

    private function thenThePublicationShouldBeSavedOnce()
    {
        $this->publicationRepositoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->isInstanceOf(Publication::class));
    }

    private function thenTheUserRepositoryShouldFindAUser() {
        $this->userRepositoryMock
            ->expects($this->once())
            ->method('findOneBy')
            ->willReturn($this->userMock);
    }

    private function whenTheCreateUserUseCaseIsExecutedWithASpecificParameters()
    {
        $this->createPublicationUseCase->execute(self::USER_ID, self::MESSAGE, null);
    }


}