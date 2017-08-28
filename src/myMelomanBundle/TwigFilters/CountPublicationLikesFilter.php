<?php

namespace myMelomanBundle\TwigFilters;

use myDomain\LikesRepositoryInterface;
use myMelomanBundle\Repository\LikesRepository;

class CountPublicationLikesFilter extends \Twig_Extension
{
    /**
     * @var LikesRepository
     */
    private $likesRepository;

    public function __construct(LikesRepositoryInterface $likesRepository)
    {
        $this->likesRepository = $likesRepository;

    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('publication_likes', array($this, 'countPublicationLikes'))
        );
    }

    public function countPublicationLikes($pubId)
    {
        $result = $this->likesRepository->countPublicationLikes($pubId);

        return (int) $result;

    }

    public function getName()
    {
        return 'count_publication_likes_extension';
    }

}