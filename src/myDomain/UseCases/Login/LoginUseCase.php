<?php

namespace myDomain\UseCases\Login;

use myDomain\DTO\LoginDTO;
use Google_Client;
use myDomain\Provider\OAuthGoogleProvider;
use myDomain\UseCases\User\CreateUserUseCase;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\Container;

class LoginUseCase
{
    const REDIRECT_HOME_STATUS = 302;
    const REDIRECT_USERPROFILE_STATUS = 301;
    const USER_NOT_FOUND = 404;

    private $googleService;
    /**
     * @var CreateUserUseCase
     */
    private $createUser;
    private $userRepository;
    /**
     * @var Container
     */
    private $container;
    private $userProfileRepository;
    private $entityManager;
    private $dispatcher;

    public function __construct(
        $createUser,
        $userRepository,
        $container,
        $userProfileRepository,
        $entityManager,
        $dispatcher)
    {
        $this->createUser = $createUser;
        $this->userRepository = $userRepository;
        $this->container = $container;
        $this->userProfileRepository = $userProfileRepository;
        $this->entityManager = $entityManager;
        $this->dispatcher = $dispatcher;
    }

    public function execute(LoginDTO $loginDTO)
    {

        //Inicia google client
        $client = $this->googleClientInit();
        $service = $this->googleServiceInit($client);
        $this->googleService = new OAuthGoogleProvider($service);
        $code = $loginDTO->getGoogleCode();
        //var_dump($code);

        if ($code == null) {
            // Create URL
            $loginDTO->setGoogleURL($this->googleService->createURL());
            $loginDTO->setStatusCode(302);

            return $loginDTO;

        }

        if (isset($code)) {
            //Authentification + token + get profile info
            $this->googleService->authenticate($code);
            $loginDTO->getSession()->set('access_token', $this->googleService->getAccessToken());


//            if ($loginDTO->getSession()->get('access_token')) {
//                $this->googleService->setAccessToken($loginDTO->getSession()->get('access_token'));
//            }

            if ($this->googleService->getAccessToken()) {

                $email = $this->googleService->getUserEmail();
                $name = $this->googleService->getUserName();
                $loginDTO->getSession()->set('email', $email);
                $loginDTO->getSession()->set('name', $name);
                $loginDTO->setEmail($email);
                $loginDTO->setUserName($name);
            }


            //user exist?
            try
            {
                $user =  $this->userRepository->findBy(array('email' => $loginDTO->getEmail()));
                if ($user) {
                    $loginDTO->setStatusCode('home');
                    return $loginDTO;
                } else {
                    $newUser = $this->createUser->execute($loginDTO->getUserName(), $loginDTO->getUserName());
                    if ($newUser) {
                        $loginDTO->setStatusCode('userProfile');
                        return $loginDTO;
                    }

                }

            } catch (Exception $e) {
                $e->getMessage();
                }

            //return $loginDTO;
        }

    }

    private function googleClientInit()
    {
        $client = new Google_Client();
        $client->setApplicationName("Melomaniacs");
        $client->setClientId($this->container->getParameter('google_client_id'));
        $client->setClientSecret($this->container->getParameter('google_secret_id'));
        $client->setRedirectUri($this->container->getParameter('google_redirect_uri'));
        $client->setScopes(array($this->container->getParameter('google_email_scope'),$this->container->getParameter('google_profile_scope')));

        return $client;
    }

    private function googleServiceInit($client)
    {
        return new \Google_Service_Oauth2($client);

    }
}