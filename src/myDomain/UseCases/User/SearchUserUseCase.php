<?php

namespace myDomain\UseCases\User;


use Doctrine\ORM\EntityManagerInterface;
use myDomain\UserRepositoryInterface;

class SearchUserUseCase
{

    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;
    private $entityManager;
    private $knpPaginator;

    public function __construct(
        UserRepositoryInterface $userRepository,
        EntityManagerInterface $entityManager,
        $knPaginator)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->knpPaginator = $knPaginator;
    }

    public function execute($search, $request)
    {
        $query =  $this->userRepository->getSearchQuery($search);

        $paginator = $this->knpPaginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );
        return $paginator;
    }


}