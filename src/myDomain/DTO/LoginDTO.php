<?php

namespace myDomain\DTO;

use Symfony\Component\HttpFoundation\Session\Session;

class LoginDTO
{
    private $statusCode;
    private $googleCode;
    private $userName;
    private $userId;
    private $email;
    /**
     * @var Session
     */
    private $session;
    private $googleURL;

    public function __construct($googleCode = null, $session)
    {
        $this->googleCode = $googleCode;
        $this->session = $session;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return string
     */
    public function getGoogleCode()
    {
        return $this->googleCode;
    }

    /**
     * @return mixed
     */
    public function getGoogleURL()
    {
        return $this->googleURL;
    }

    /**
     * @param mixed $googleURL
     */
    public function setGoogleURL($googleURL)
    {
        $this->googleURL = $googleURL;
    }


    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param mixed $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

}