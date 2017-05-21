<?php

namespace myMelomanBundle\Controller;

use myDomain\DTO\UserProfileDTO;
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

        $userId = $request->getSession()->get('user');
        $showProfile = $this->get('app.application.usecases.userprofile.show')->execute($userId);
        //Check if userProfile exists.


//        if ($user->getUserProfile() == null) {
//            //Create user Profile
//            $userProfileDTO = new UserProfileDTO();
//            $userProfileDTO->setPicture($request->getSession()->get('picture'));
//            $userProfileDTO->setAboutMe($request->request->get('aboutme'));
//            $userProfileDTO->setTastes($request->request->get('tastes'));
//            $userProfileDTO->setFavourite($request->request->get('favourites'));
//            $this->get('app.application.usecases.userprofile.create')->execute($userProfileDTO);
//
//        }


            // return filled fields
        //if not
            //empty form.

        return $this->render('userProfileView/userProfileView.html.twig',
            array(
                'userProfile' => $showProfile
            ));

    }

}