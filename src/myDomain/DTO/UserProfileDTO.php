<?php

namespace myDomain\DTO;


class UserProfileDTO
{
    private $user;
    private $picture;
    private $aboutMe;
    private $birth;
    private $tastes = [];
    private $favourite = [];

    public function __construct($user             ,
                                $aboutMe    = null,
                                $birth      = null,
                                $tastes     = null,
                                $favourite  = null)
    {
        $this->user         = $user;
        $this->aboutMe      = $aboutMe;
        $this->birth        = \DateTime::createFromFormat('Y-m-d', $birth);
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
     * @return mixed $tastes[]
     */
    public function getTastes()
    {
        return $this->tastes;
    }

    /**
     * @param mixed $tastes[]
     */
    public function setTastes($tastes)
    {
        $this->tastes = $tastes;
    }

    /**
     * @return mixed $favourite[]
     */
    public function getFavourite()
    {
        return $this->favourite;
    }

    /**
     * @param mixed $favourite[]
     */
    public function setFavourite($favourite)
    {
        $this->favourite = $favourite;
    }

    /**
     * @return $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param int $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return \DateTime
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * @param \DateTime $birth
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;
    }


}