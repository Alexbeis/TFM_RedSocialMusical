<?php

namespace myMelomanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function homeAction(Request $request)
    {
        if (!$request->getSession()->get('user')) {
            return $this->redirectToRoute('login');
        }

        return $this->render('homeView/homeView.html.twig');

    }

    public function userProfileAction(Request $request)
    {
        if (!$request->getSession()->get('user')) {
            return $this->redirectToRoute('login');
        }

        return $this->render('userProfileView/userProfileView.html.twig');

    }

}