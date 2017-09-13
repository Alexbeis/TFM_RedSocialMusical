<?php

use Behat\Behat\Context\Context;
use myDomain\Entity\MusicalTaste;

class MusicalTasteContext implements Context
{
    private $musicalTaste;
    private $name;

    public function __construct()
    {

    }

    /**
     * @Given a musicalTaste :arg1
     */
    public function aMusicaltaste($arg1)
    {
        $this->name = $arg1;
    }

    /**
     * @Then A musical taste is created
     */
    public function aUserIsCreated()
    {
        $this->musicalTaste = new MusicalTaste();
        $this->musicalTaste->setName($this->name);
        \PHPUnit_Framework_TestCase::assertInstanceOf(MusicalTaste::class,$this->musicalTaste);
    }

}