<?php

namespace myDomain\UseCases\Follow;

use myDomain\FollowingRepositoryInterface;
use myDomain\UserRepositoryInterface;

class GetUsersFollowing
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
        $following = $this->followingRepository->findBy(array('user' => $user));

        return $following;
    }

}