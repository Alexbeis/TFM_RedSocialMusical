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
     * @var UserProfile
     */

    private $user_profile;


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
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return \AppBundle\Component\Domain\Entity\UserProfile
     */
    public function getUserProfile()
    {
        return $this->user_profile;
    }

    /**
     * @param \AppBundle\Component\Domain\Entity\UserProfile $user_profile
     */
    public function setUserProfile($user_profile)
    {
        $this->user_profile = $user_profile;
    }
}

