<?php

namespace myDomain\UseCases\Publication;

use Doctrine\ORM\EntityManagerInterface;
use myDomain\Entity\Publication;
use myDomain\Entity\User;
use myDomain\PublicationRepositoryInterface;
use myDomain\UserRepositoryInterface;
use myMelomanBundle\Repository\PublicationRepository;
use myMelomanBundle\Repository\UserRepository;

class CreatePublicationUseCase
{
    /**
     * @var PublicationRepository
     */
    private $publicationRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;
    private $entityManager;

    public function __construct(
        PublicationRepositoryInterface $publicationRepository,
        UserRepositoryInterface $userRepository,
        EntityManagerInterface $entityManager
    )
    {
        $this->publicationRepository = $publicationRepository;
        $this->userRepository        = $userRepository;
        $this->entityManager         = $entityManager;
    }

    public function execute($userId, $message = null, $uri = null)
    {
        try{
            /**
             * @var User $user
             */
            $user = $this->userRepository->findOneBy(array('id'=>$userId));

            $publication = new Publication();
            $publication->setMessage($message == null ? '' : $message);
            $publication->setCreatedAt(new \DateTime());
            $publication->setUser($user);
            $publication->setStatus(0);
            $publication->setLink($uri == null ? '' : $uri);
            //\Doctrine\Common\Util\Debug::dump($publication);
            $this->publicationRepository->create($publication);

            $flush = $this->entityManager->flush();

            if ($flush != null) {
                return false;
            }
            return $publication;

        } catch (\Exception $e) {
            return false;
        }
    }

}