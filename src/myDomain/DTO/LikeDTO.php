<?php

namespace myDomain\DTO;

class LikeDTO
{
    private $publicationId;
    private $userId;

    public function __construct(int $userId, int $publicationId)
    {
        $this->userId           = $userId;
        $this->publicationId    = $publicationId;
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

    /**
     * @return int
     */
    public function getPublicationId()
    {
        return $this->publicationId;
    }

    /**
     * @param int $publicationId
     */
    public function setPublicationId($publicationId)
    {
        $this->publicationId = $publicationId;
    }

}