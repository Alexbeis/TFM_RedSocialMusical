<?php

namespace AppBundle\WebBundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function homeAction(Request $request)
    {
        return $this->render('homeView/homeView.html.twig');

    }

}