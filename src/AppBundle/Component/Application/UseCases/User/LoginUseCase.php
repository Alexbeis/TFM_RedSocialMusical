<?php

namespace AppBundle\Component\Application\UseCases\User;


use Google_Service_Oauth2;

class LoginUseCase
{
    private $clientSecret;
    private $clientID ;
    private $service;
    /**
     * @var \Google_Client
     */
    private $google_client;
    private $userRepository;
    private $entityManager;

    public function __construct($userRepository, $entityManager, $dispatcher)
    {
        $this->userRepository = $userRepository;
        $this->google_client = new \Google_Client();
        $this->entityManager;
        $this->userRepository;
        //$this->google_client->setApplicationName("Melomaniacs");
        $this->google_client->setClientId('721970566997-72emhffh5962uvddmr4s0lp3duq4rl4o.apps.googleusercontent.com');
        $this->google_client->setClientSecret('s43KLQ1Wilx23Ae2aXqTqTvO');
        $this->google_client->setRedirectUri('http://melomaniacs.com/app_dev.php');
        $this->google_client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile'));

        $this->service = new Google_Service_Oauth2($this->google_client);

    }

    public function checkToken($code)
    {
        if ($code) {
            $this->google_client->authenticate($code);
            return true;
        }
        return false;
    }

    public function login($accessToken)
    {
        if ($accessToken) {
            $this->google_client->setAccessToken($accessToken);
            //return $this->google_client->getAccessToken();
        }

    }

    public function getUserInfo()
    {
        if($this->google_client->getAccessToken()) {
            $user = $this->service->userinfo->get();
            var_dump($user->getEmail());
            return $user;


        }
        else
            return $this->google_client->createAuthUrl();

    }


}