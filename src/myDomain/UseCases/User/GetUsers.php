<?php

namespace myDomain\UseCases\User;

use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\PaginatorBundle\DependencyInjection\KnpPaginatorExtension;
use myDomain\UserRepositoryInterface;
use myMelomanBundle\Repository\UserRepository;

class GetUsers
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

   public function execute($request)
   {
       $query =  $this->userRepository->getQuery();

       $paginator = $this->knpPaginator->paginate(
           $query,
           $request->query->getInt('page', 1),
           5
       );
       return $paginator;
   }

}