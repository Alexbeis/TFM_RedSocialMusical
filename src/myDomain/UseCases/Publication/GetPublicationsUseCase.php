<?php

namespace myDomain\UseCases\Publication;


use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\PaginatorBundle\DependencyInjection\KnpPaginatorExtension;
use myDomain\FollowingRepositoryInterface;
use myDomain\UserRepositoryInterface;
use myMelomanBundle\Repository\PublicationRepository;

class GetPublicationsUseCase
{
    private $publicationRepository;
    private $userRepository;
    private $followingRepository;
    private $entityManager;
    private $paginator;

    public function __construct(
        PublicationRepository $publicationRepository,
        UserRepositoryInterface $userRepository,
        FollowingRepositoryInterface $followingRepository,
        EntityManagerInterface $entityManager,
        $paginator)
    {
        $this->publicationRepository    = $publicationRepository;
        $this->userRepository           = $userRepository;
        $this->followingRepository      = $followingRepository;
        $this->entityManager            = $entityManager;
        $this->paginator                = $paginator;
    }

    public function execute($id, $request)
    {
        $user           = $this->userRepository->findOneBy(array('id' => $id));
        $following      = $this->followingRepository->findBy(array('user' => $user));
        //\Doctrine\Common\Util\Debug::dump($following);
        $myFollows = [];

        foreach ($following as $follow) {
            $myFollows[] = $follow->getFriend();
        }

        $query = $this->publicationRepository->findMeAndFriendPublications($id, $myFollows);

        $pagination = $this->paginator->paginate(
            $query,
            $request->query->getInt('page',1),
            5
            );

        return $pagination;


    }


}