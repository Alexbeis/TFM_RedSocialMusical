<?php

namespace myMelomanBundle\TwigFilters;

use Doctrine\Bundle\DoctrineBundle\Registry;
use myDomain\UseCases\Follow\GetUsersFollowers;
use myDomain\UseCases\Follow\GetUsersFollowing;
use myDomain\UseCases\Like\GetUserLikes;


class UserStadisticsFilter extends \Twig_Extension
{
    /**
     * @var Registry
     */
    private $getUsersFollowing;
    private $getUsersFollowers;
    private $getUserLikes;

    public function __construct(
        GetUsersFollowing $getUsersFollowing,
        GetUsersFollowers $getUsersFollowers,
        GetUserLikes $getUserLikes)
    {
        $this->getUsersFollowing  = $getUsersFollowing;
        $this->getUsersFollowers  = $getUsersFollowers;
        $this->getUserLikes       = $getUserLikes;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('userStats', array($this, 'userStatsFilter'))
        );
    }


    public function userStatsFilter($userId, $option)
    {
        if ($option == 'following') {
            return count($this->getUsersFollowing->execute($userId));
        } elseif ($option == 'follower') {
            return count($this->getUsersFollowers->execute($userId));
        } else {
            return count($this->getUserLikes->execute($userId));
        }

    }

    public function getName()
    {
        return 'userStats_extension';
    }


}