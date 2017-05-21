<?php

namespace myDomain\DTO;


class UserProfileDTO
{
    private $picture;
    private $aboutMe;
    private $tastes;
    private $favourite;

    public function __construct($picture = null, $aboutMe = null, $tastes = null, $favourite = null)
    {
        $this->picture      = $picture;
        $this->aboutMe      = $aboutMe;
        $this->tastes       = $tastes;
        $this->favourite    = $favourite;

    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
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
    public function setAboutMe($aboutMe)
    {
        $this->aboutMe = $aboutMe;
    }

    /**
     * @return mixed
     */
    public function getTastes()
    {
        return $this->tastes;
    }

    /**
     * @param mixed $tastes
     */
    public function setTastes($tastes)
    {
        $this->tastes = $tastes;
    }

    /**
     * @return mixed
     */
    public function getFavourite()
    {
        return $this->favourite;
    }

    /**
     * @param mixed $favourite
     */
    public function setFavourite($favourite)
    {
        $this->favourite = $favourite;
    }


}