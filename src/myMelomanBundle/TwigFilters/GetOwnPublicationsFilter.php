<?php

namespace myMelomanBundle\TwigFilters;

use myDomain\PublicationRepositoryInterface;

class GetOwnPublicationsFilter extends \Twig_Extension
{
    /**
     * @var Registry
     */
    private $publicationRepository;

    public function __construct(
        PublicationRepositoryInterface $publicationRepository)
    {
        $this->publicationRepository = $publicationRepository;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('getOwnPublications', array($this, 'execute'))
        );
    }

    public function execute($userId)
    {
       return count($this->publicationRepository->findBy(array('user' => $userId)));
    }

    public function getName()
    {
        return 'getOwnPublications_extension';
    }

}