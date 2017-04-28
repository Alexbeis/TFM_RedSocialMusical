<?php

namespace AppBundle\WebBundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Google_Client;
use Google_Service_Oauth2;
use Symfony\Component\HttpFoundation\Session\Session;


class UserLoginController extends Controller
{
    private $client;
    private $service;
    private $session;
    private $userInfo;
    private $em;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->session = new Session(); // Force to create a session
    }


    public function loginAction(Request $request)
    {

        $authUrl = null;
        //$this->session = $request->getSession();
        $this->googleInit();
        $authUrl = $this->client->createAuthUrl();

        return $this->render('loginView/googleLogin.html.twig',
            array('authUrl' => $authUrl )
        );

    }

    public function validateAction(Request $request)
    {
        if ($this->session == null) {
            $this->session->start();
        }
        $this->googleInit();

        if ($request->get('code')) {
            $this->client->authenticate($request->get('code'));
            $this->session->set('access_token',$this->client->getAccessToken());
            header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
        }

        if ($this->session->get('access_token')) {
            $this->client->setAccessToken($this->session->get('access_token'));
        }

        if ($this->client->getAccessToken()) {
            $this->userinfo = $this->service->userinfo->get();
            $this->session->set('familyName', $this->userinfo->getFamilyName());
            $this->session->set('email', $this->userinfo->getEmail());

        }
        //TODO: Create / update user on DDBB

        return $this->redirectToRoute('home');


    }


    private function googleInit()
    {
        $this->client->setApplicationName("Melomaniacs");
        $this->client->setClientId('721970566997-72emhffh5962uvddmr4s0lp3duq4rl4o.apps.googleusercontent.com');
        $this->client->setClientSecret('s43KLQ1Wilx23Ae2aXqTqTvO');
        $this->client->setRedirectUri('http://melomaniacs.com/app_dev.php/validate/');
        $this->client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile'));
        $this->service = new Google_Service_Oauth2($this->client);

    }

}