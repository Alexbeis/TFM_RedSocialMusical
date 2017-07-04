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

        $userid = $request->getSession()->get('user');
        $publications = $this->get('app.application.usecases.publication.get')->execute($userid, $request);
        return $this->render('homeView/homeView.html.twig',
            array(
                'pagination' => $publications
            ));

    }

    public function userEditProfileAction(Request $request)
    {
        if (!$request->getSession()->get('user')) {
            return $this->redirectToRoute('login');
        }

        $userId = $request->getSession()->get('user');
        $user   = $this->get('app.application.usecases.edit.userprofile.show')->execute($userId);
        $tastes = $this->get('app.application.usecases.userprofile.get.musical.tastes')->execute();

        if ($user) {
            return $this->render('userProfileView/userProfileView.html.twig',
                array(
                    'userProfile'   => $user,
                    'tastes'        => $tastes
                )
            );
        } else {
            return $this->redirectToRoute('home');
        }

    }

    public function userProfilePageAction(Request $request)
    {
        if (!$request->getSession()->get('user')) {
            return $this->redirectToRoute('login');
        }

        $userId        = $request->query->get('id');
        $resultArray   = $this->get('app.application.usecases.page.userprofile.show')->execute($userId);
        //\Doctrine\Common\Util\Debug::dump($resultArray);
        $tastes        = $this->get('app.application.usecases.userprofile.get.musical.tastes')->execute();

        if ($resultArray) {
            return $this->render('userProfileView/userProfilePageView.html.twig',
                array(
                    'userProfile'   => $resultArray['user'],
                    'publications'  => $resultArray['publications'],
                    'tastes'        => $tastes
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
        $currentTastes  = $this->get('app.application.usecases.get.checked.tastes')->execute($request);

        $userProfileDTO = new UserProfileDTO($user, $aboutMe, $birth , $currentTastes);

        $updateUserProfile = $this->get('app.application.usescases.user.update');
        $user = $updateUserProfile->execute($user, $userProfileDTO);


        return $this->redirectToRoute('home');

    }

    public function userListAction(Request $request)
    {
        $pagination = $this->get('app.application.usescases.user.get')->execute($request);
        return $this->render('userView/user-list.html.twig',
            array(
                'pagination' => $pagination
            )
        );
    }

    public function searchAction(Request $request)
    {
        $search = $request->query->get('search');

        $pagination = $this->get('app.application.usescases.user.search')->execute($search, $request);

        return $this->render('userView/user-list.html.twig',
            array(
                'pagination' => $pagination
            )
        );

    }
}