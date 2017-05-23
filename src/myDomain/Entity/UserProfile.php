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
     * @var MusicalTaste[]
     */

    private $musicalTaste;

    /**
     * @var FavouriteArtist[]
     */
    private $favouriteArtist;


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
     * Set musicalTaste[]
     *
     * @param
     *
     */
    public function setMusicalTaste($musicalTaste)
    {
        $this->musicalTaste = $musicalTaste;

    }

    /**
     * @var MusicalTaste[]
     */
    public function getMusicalTaste()
    {
        return $this->musicalTaste;
    }

    /**
     * Set favouriteArtist
     *
     * @param FavouriteArtist[]
     *
     */
    public function setFavouriteArtist($favouriteArtist)
    {
        $this->favouriteArtist = $favouriteArtist;

    }

    /**
     *
     * @return FavouriteArtist[]
     */
    public function getFavouriteArtist()
    {
        return $this->favouriteArtist;
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

