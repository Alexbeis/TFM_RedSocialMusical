<?php

namespace myDomain\Entity;

class Comments
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $user;

    /**
     * @var string
     */
    private $message;

    /**
     * @var Publication
     */
    private $publication;

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
     * @return int
     */
    public function getUser(): int
    {
        return $this->user;
    }

    /**
     * @param int $user
     */
    public function setUser(int $user)
    {
        $this->user = $user;
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
     * @return Publication
     */
    public function getPublication(): Publication
    {
        return $this->publication;
    }

    /**
     * @param Publication $publication
     */
    public function setPublication(Publication $publication)
    {
        $this->publication = $publication;
    }
}