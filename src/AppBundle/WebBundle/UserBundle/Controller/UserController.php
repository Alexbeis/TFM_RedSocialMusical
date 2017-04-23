<?php

namespace AppBundle\WebBundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Google_Client;
use Google_Service_Oauth2;


class UserController extends Controller
{

    public function loginAction(Request $request)
    {
        /**
         * @var Google_Client
         */
        $client = new Google_Client();
        $client->setApplicationName("Melomaniacs");
        $client->setClientId('721970566997-72emhffh5962uvddmr4s0lp3duq4rl4o.apps.googleusercontent.com');
        $client->setClientSecret('s43KLQ1Wilx23Ae2aXqTqTvO');
        $client->setRedirectUri('http://melomaniacs.com');
        $client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile'));
        //$client->setDeveloperKey('**************');
        $service = new Google_Service_Oauth2($client);
        $session = $request->getSession();
        $authUrl = null;


        if ($request->get('logout')){
            $session->remove('access_token');
            header('Location: http://melomaniacs.com');
        }

        if ($request->get('code')) {
            $client->authenticate($request->get('code'));
            $session->set('access_token',$client->getAccessToken());
            header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
        }

        if ($session->get('access_token')) {
            $client->setAccessToken($session->get('access_token'));
        }

        if ($client->getAccessToken())
        {
            $userinfo = $service->userinfo->get();
            var_dump($userinfo->getFamilyName());


        } else
        {
            $authUrl = $client->createAuthUrl();
        }
        return $this->render('loginView/googleLogin.html.twig',
            array('authUrl' => $authUrl )
        );

    }
    public function loggedAction (Request $request)
    {
        $code = $request->get('code');
        var_dump($code);
        return new Response("redirected",200);
    }



}