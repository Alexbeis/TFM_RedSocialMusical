<?php

use myDomain\Entity\User;
use Behat\Behat\Context\Context;

class SaveUserContext implements Context
{
    private $user;
    private $email;
    private $username;
    private $image;

    public function __construct()
    {

    }


    /**
     * @Given a email :arg1 and  username :arg2 and image :arg3
     */

    public function aEmailAndUsernameAndImage($arg1, $arg2, $arg3)
    {
        $this->email = $arg1;
        $this->username = $arg2;
        $this->image = $arg3;
    }


    /**
     * @Then A user is created
     */
    public function aUserIsCreated()
    {
        $this->user = new User();
        $this->user->setEmail($this->email);
        $this->user->setImage($this->image);
        $this->user->setUsername($this->username);
        \PHPUnit_Framework_TestCase::assertInstanceOf(User::class,$this->user);
    }


}