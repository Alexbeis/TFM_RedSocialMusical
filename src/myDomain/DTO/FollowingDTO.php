<?php


namespace myDomain\DTO;


class FollowingDTO
{
    /**
     * @var int
     */
    private $userId;
    /**
     * @var int
     */
    private $friendId;

    public function __construct($userId, $friendId)
    {
        $this->userId = $userId;
        $this->friendId = $friendId;
    }

    /**
     * @return int
     */
    public function getFriendId()
    {
        return $this->friendId;
    }

    /**
     * @param int $friendId
     */
    public function setFriendId($friendId)
    {
        $this->friendId = $friendId;
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