<?php

namespace myDomain\DTO;

class CommentDTO
{
    /**
     * @var int
     */
    private $userId;
    /**
     * @var int
     */
    private $publicationId;
    /**
     * @var string
     */
    private $message;

    /**
     * @var bool
     */
    private $result;

    public function __construct(int $userId, int $publicationId, string $message, bool $result = false)
    {
        $this->userId           = $userId;
        $this->publicationId    = $publicationId;
        $this->message          = $message;
        $this->result           = $result;

    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getPublicationId(): int
    {
        return $this->publicationId;
    }

    /**
     * @param int $publicationId
     */
    public function setPublicationId(int $publicationId)
    {
        $this->publicationId = $publicationId;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return boolean
     */
    public function isResult(): bool
    {
        return $this->result;
    }

    /**
     * @param boolean $result
     */
    public function setResult(bool $result)
    {
        $this->result = $result;
    }

}