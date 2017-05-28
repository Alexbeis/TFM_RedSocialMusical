<?php

namespace myMelomanBundle\Controller;

use myDomain\DTO\UserProfileDTO;
use myDomain\Entity\UserProfile;
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
        $user = $this->get('app.application.usecases.userprofile.show')->execute($userId);

        if ($user) {
            return $this->render('userProfileView/userProfileView.html.twig',
                array(
                    'userProfile' => $user
                )
            );
        } else {
            return $this->redirectToRoute('home');
        }


    }

    public function createUserProfileAction(Request $request)
    {
        if (!$request->getSession()->get('user')) {
            return $this->redirectToRoute('login');
        }

        $user           = $request->request->get('user');
        $aboutMe        = $request->request->get('aboutme');
        $birth          = $request->request->get('birth');
        $currentTastes  = $this->getCheckedTastes($request);

        $userProfileDTO = new UserProfileDTO($user, $aboutMe, $birth , $currentTastes);

        $updateUserProfile = $this->get('app.application.usescases.user.update');
        $user= $updateUserProfile->execute($user, $userProfileDTO);


        return $this->redirectToRoute('home');

    }

    private function getCheckedTastes(Request $request)
    {
        $tastes = [ '1'=>'rock', '2'=>'funk', '3'=>'techno', '4'=>'reggae', '5'=>'blues', '6'=>'mestizaje', '7'=>'edm', '8'=> 'drum&bass', '9'=>'hardrock', '10'=>'metal'];
        $currentTastes = [];

        foreach ($tastes as $key => $taste) {

            if ($request->request->get($taste) == 'on') {
                $currentTastes[$key] =  $taste;
            }
        }
        return $currentTastes;
    }

}