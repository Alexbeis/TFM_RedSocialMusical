<?php

namespace myDomain\UseCases\Follow;

use myDomain\FollowingRepositoryInterface;
use myDomain\UserRepositoryInterface;

class GetUsersFollowers
{
    private $followingRepository;
    private $userRepository;

    public function __construct(
        FollowingRepositoryInterface $followingRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->followingRepository = $followingRepository;
        $this->userRepository = $userRepository;
    }

    public function execute($userId)
    {
        $user = $this->userRepository->find($userId);
        // I'm the friend
        $followers = $this->followingRepository->findBy(array('friend' => $user));

        return $followers;
    }

}