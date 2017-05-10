<?php

namespace myMelomanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Google_Client;
use Google_Service_Oauth2;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController extends Controller
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

        $createUserUseCase = $this->get('app.application.usecases.user.create');
        $user = $createUserUseCase->execute($this->session->get('familyName'), $this->session->get('email'));

        return $this->redirectToRoute('home');


    }


    private function googleInit()
    {
        $this->client->setApplicationName("Melomaniacs");
        $this->client->setClientId($this->getParameter('google_client_id'));
        $this->client->setClientSecret($this->getParameter('google_secret_id'));
        $this->client->setRedirectUri($this->getParameter('google_redirect_uri'));
        $this->client->setScopes(array($this->getParameter('google_email_scope'),$this->getParameter('google_profile_scope')));
        $this->service = new Google_Service_Oauth2($this->client);

    }

}