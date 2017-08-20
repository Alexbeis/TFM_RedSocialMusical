<?php

namespace myDomain\Entity;


class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var \DateTime
     */
    private $joinDate;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $aboutMe;

    /**
     * @var string
     */
    private $image;

    /**
     * @var \DateTime | null
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
     * @var Publication[]
     */
    private $publication;

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
     * Set username
     *
     * @param string $username
     *
     */
    public function setUsername($username)
    {
        $this->username = $username;

    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set joinDate
     *
     * @param \DateTime $joinDate
     *
     */
    public function setJoinDate($joinDate)
    {
        $this->joinDate = $joinDate;
    }

    /**
     * Get joinDate
     *
     * @return \DateTime
     */
    public function getJoinDate()
    {
        return $this->joinDate;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     */
    public function setEmail($email)
    {
        $this->email = $email;

    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * @return string
     */
    public function getAboutMe()
    {
        return $this->aboutMe;
    }

    /**
     * @param string $aboutMe
     */
    public function setAboutMe(string $aboutMe)
    {
        $this->aboutMe = $aboutMe;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image)
    {
        $this->image = $image;
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

    /**
     * @return MusicalTaste[]
     */
    public function getMusicalTaste()
    {
        return $this->musicalTaste;
    }

    /**
     * @param MusicalTaste[] $musicalTaste
     */
    public function setMusicalTaste(array $musicalTaste)
    {
        $this->musicalTaste = $musicalTaste;
    }

    /**
     * @return FavouriteArtist[]
     */
    public function getFavouriteArtist()
    {
        return $this->favouriteArtist;
    }

    /**
     * @param FavouriteArtist[] $favouriteArtist
     */
    public function setFavouriteArtist(array $favouriteArtist)
    {
        $this->favouriteArtist = $favouriteArtist;
    }

    /**
     * @return Publication[]
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * @param Publication[] $publication
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;
    }


}

