<?php

namespace myMelomanBundle\TwigFilters;

use myDomain\Entity\User;
use myDomain\FollowingRepositoryInterface;
use myDomain\UserRepositoryInterface;

class FollowingFilter extends \Twig_Extension
{
    private $userRepository;
    private $followingRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        FollowingRepositoryInterface $followingRepository)
    {
        $this->userRepository       = $userRepository;
        $this->followingRepository  = $followingRepository;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('following', array($this, 'followingFilter'))
        );
    }

    /**
     * @param int $userId
     * @param User $friend
     * @return bool
     */
    public function followingFilter(int $userId, User $friend)
    {
        $user = $this->userRepository->findOneBy(
            array(
                'id' => $userId
            )
        );

        $following = $this->followingRepository->findOneBy(
            array(
                'user' => $user,
                'friend'=> $friend
            )
        );

        if (!empty($following) && is_object($following)) {
            return true;
        } else return false;

    }

    public function getName()
    {
        return 'following_extension';
    }


}