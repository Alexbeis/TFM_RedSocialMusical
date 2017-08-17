<?php

namespace myDomain\UseCases\Like;

use myDomain\LikesRepositoryInterface;
use myDomain\UserRepositoryInterface;

class GetUserLikes
{
    private $likesRepository;
    private $userRepository;

    public function __construct(
        LikesRepositoryInterface $likesRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->likesRepository = $likesRepository;
        $this->userRepository = $userRepository;
    }

    public function execute($userId)
    {
        $user = $this->userRepository->find($userId);
        $likes = $this->likesRepository->findBy(array('user' => $user));

        return $likes;
    }
}