<?php

namespace myDomain\Entity;


class UserProfile
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $aboutMe;

    /**
     * @var string
     */
    private $image;

    /**
     * @var \DateTime
     */
    private $birthDate;

    /**
     * @var string
     */

    private $musicalTastes;

    /**
     * @var string
     */
    private $favouriteArtists;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set aboutMe
     *
     * @param string $aboutMe
     *
     */
    public function setAboutMe($aboutMe)
    {
        $this->aboutMe = $aboutMe;


    }

    /**
     * Get aboutMe
     *
     * @return string
     */
    public function getAboutMe()
    {
        return $this->aboutMe;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     */
    public function setImage($image)
    {
        $this->image = $image;


    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set musicalTastes
     *
     * @param string $musicalTastes
     *
     */
    public function setMusicalTastes($musicalTastes)
    {
        $this->musicalTastes = $musicalTastes;

    }

    /**
     * Get musicalTastes
     *
     * @return string
     */
    public function getMusicalTastes()
    {
        return $this->musicalTastes;
    }

    /**
     * Set favouriteArtists
     *
     * @param string $favouriteArtists
     *
     */
    public function setFavouriteArtists($favouriteArtists)
    {
        $this->favouriteArtists = $favouriteArtists;


    }

    /**
     * Get favouriteArtists
     *
     * @return string
     */
    public function getFavouriteArtists()
    {
        return $this->favouriteArtists;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate(\DateTime $birthDate)
    {
        $this->birthDate = $birthDate;
    }
}

