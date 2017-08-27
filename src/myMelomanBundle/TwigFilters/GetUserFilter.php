<?php

namespace myMelomanBundle\TwigFilters;

use Doctrine\Bundle\DoctrineBundle\Registry;
use myDomain\Entity\Publication;
use myDomain\LikesRepositoryInterface;
use myDomain\UserRepositoryInterface;

class GetUserFilter extends \Twig_Extension
{
    /**
     * @var Registry
     */
    private $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository)
    {
        $this->userRepository   = $userRepository;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('getUser', array($this, 'GetUserFilter'))
        );
    }

    /**
     * @param int $userId
     * @return bool
     */
    public function GetUserFilter(int $userId)
    {
        $user = $this->userRepository->findOneBy(
            array(
                'id' => $userId
            )
        );


        if (!empty($user) && is_object($user)) {
            return $user->getUserName();
        } else return false;

    }

    public function getName()
    {
        return 'get_user_extension';
    }
}