<?php

use Behat\Behat\Context\Context;

class LikesContext implements Context
{
    private $likeDTO;
    private $user;
    private $publication;
    private $like;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {

    }

    /**
     * @Given a user :arg1 and publication :arg2
     */
    public function aUserAndPublication($arg1, $arg2)
    {
        $this->user = $arg1;
        $this->publication = $arg2;
        $this->likeDTO = new \myDomain\DTO\LikeDTO($this->user, $this->publication);
    }

    /**
     * @When /the argument are valid$/
     */
    public function theArgumentAreValid()
    {
        $this->like = new \myDomain\Entity\Likes($this->likeDTO);
    }

    /**
     * @Then a new like object should be created
     */
    public function aNewLikeObjectShouldBeCreated()
    {
        if (!($this->like instanceof \myDomain\Entity\Likes)) {
            throw new \Exception("Not Like Object");
        }
    }

}