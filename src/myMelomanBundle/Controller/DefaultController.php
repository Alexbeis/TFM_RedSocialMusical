<?php

namespace myMelomanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('myMelomanBundle:Default:index.html.twig');
    }
}
