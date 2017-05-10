<?php

namespace myDomain\DTO;

class LoginDTO
{
    private $statusCode;
    private $googleCode;
    private $session;

    public function __construct($googleCode = '')
    {
        $this->googleCode = $googleCode;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getGoogleCode()
    {
        return $this->googleCode;
    }


}