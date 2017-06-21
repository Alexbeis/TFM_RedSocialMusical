<?php

namespace myMelomanBundle\TwigFilters;

use Doctrine\Bundle\DoctrineBundle\Registry;
use myDomain\Entity\Publication;
use myDomain\LikesRepositoryInterface;
use myDomain\UserRepositoryInterface;

class LikesFilter extends \Twig_Extension
{
    /**
     * @var Registry
     */
    private $userRepository;
    private $likesRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        LikesRepositoryInterface $likesRepository)
    {
        $this->userRepository   = $userRepository;
        $this->likesRepository  = $likesRepository;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('liked', array($this, 'likesFilter'))
        );
    }

    /**
     * @param int $userId
     * @param Publication $publication
     * @return bool
     */
    public function likesFilter(int $userId, Publication $publication)
    {
        $user = $this->userRepository->findOneBy(
            array(
                'id' => $userId
            )
        );

        $liked = $this->likesRepository->findOneBy(
            array(
                'user' => $user,
                'publication'=> $publication
            )
        );

        if (!empty($liked) && is_object($liked)) {
            return true;
        } else return false;

    }

    public function getName()
    {
        return 'likes_extension';
    }

}