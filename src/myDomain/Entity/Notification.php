<?php

namespace myDomain\Entity;

class Notification
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $userGenerateId;

    /**
     * @var boolean
     */
    private $read;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $extra;

    /**
     * @var User
     */
    private $user;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getUserGenerateId(): int
    {
        return $this->userGenerateId;
    }

    /**
     * @param int $userGenerateId
     */
    public function setUserGenerateId(int $userGenerateId)
    {
        $this->userGenerateId = $userGenerateId;
    }

    /**
     * @return boolean
     */
    public function isRead(): bool
    {
        return $this->read;
    }

    /**
     * @param boolean $read
     */
    public function setRead(bool $read)
    {
        $this->read = $read;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getExtra(): string
    {
        return $this->extra;
    }

    /**
     * @param string|null $extra
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }


}