<?php

namespace myMelomanBundle\TwigFilters;

use Doctrine\Bundle\DoctrineBundle\Registry;
use myDomain\UseCases\Follow\GetUsersFollowers;
use myDomain\UseCases\Follow\GetUsersFollowing;


class UserStadisticsFilter extends \Twig_Extension
{
    /**
     * @var Registry
     */
    private $getUsersFollowing;
    private $getUsersFollowers;

    public function __construct(
        GetUsersFollowing $getUsersFollowing,
        GetUsersFollowers $getUsersFollowers)
    {
        $this->getUsersFollowing   = $getUsersFollowing;
        $this->getUsersFollowers  = $getUsersFollowers;
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
        }
        else {
            return count($this->getUsersFollowers->execute($userId));
        }
//
//        if (!empty($liked) && is_object($liked)) {
//            return true;
//        } else return false;

    }

    public function getName()
    {
        return 'userStats_extension';
    }


}