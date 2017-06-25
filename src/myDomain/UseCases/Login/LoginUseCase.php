<?php

namespace myDomain\UseCases\Login;

use myDomain\DTO\LoginDTO;
use Google_Client;
use myMelomanBundle\Provider\OAuthGoogleProvider;
use myDomain\UseCases\User\CreateUserUseCase;
use Symfony\Component\Config\Definition\Exception\Exception;

class LoginUseCase
{

    private $googleService;
    /**
     * @var CreateUserUseCase
     */
    private $createUser;
    private $userRepository;
    private $entityManager;
    private $google_client_id;
    private $google_secret_id;
    private $google_redirect_uri;
    private $google_email_scope;
    private $google_profile_scope;

    public function __construct(
        $createUser,
        $userRepository,
        $userProfileRepository,
        $entityManager,
        $google_client_id,
        $google_secret_id,
        $google_redirect_uri,
        $google_email_scope,
        $google_profile_scope)
    {
        $this->createUser           = $createUser;
        $this->userRepository       = $userRepository;
        $this->entityManager        = $entityManager;
        $this->google_client_id     = $google_client_id;
        $this->google_secret_id     = $google_secret_id;
        $this->google_redirect_uri  = $google_redirect_uri;
        $this->google_email_scope   = $google_email_scope;
        $this->google_profile_scope = $google_profile_scope;
    }

    public function execute(LoginDTO $loginDTO)
    {
        $client     = $this->googleClientInit();
        $service    = $this->googleServiceInit($client);
        $this->googleService = new OAuthGoogleProvider($service);
        $code       = $loginDTO->getGoogleCode();

        if ($code == null) {
            $loginDTO->setGoogleURL($this->googleService->createURL());

            return $loginDTO;
        }

        if (isset($code)) {

            $this->googleService->authenticate($code);
            $loginDTO->getSession()->set('access_token', $this->googleService->getAccessToken());

            if ($this->googleService->getAccessToken()) {

                $email      = $this->googleService->getUserEmail();
                $name       = $this->googleService->getUserName();
                $picture    = $this->googleService->getPictureUrl();
                $loginDTO->getSession()->set('email', $email);
                $loginDTO->getSession()->set('name', $name);
                $loginDTO->getSession()->set('picture', $picture);
                $loginDTO->setEmail($email);
                $loginDTO->setUserName($name);
                $loginDTO->setPicture($picture);
            }

            try
            {
                $user =  $this->userRepository->findBy(array('email' => $loginDTO->getEmail()));
                if ($user) {

                    $loginDTO->setStatusCode('home');
                    $loginDTO->setUserId($user[0]->getId());

                    return $loginDTO;
                } else {
                    $newUser = $this->createUser->execute($loginDTO->getUserName(), $loginDTO->getEmail(), $loginDTO->getPicture());
                    if ($newUser) {
                        $loginDTO->setStatusCode('user_profile');
                        $loginDTO->setUserId($newUser->getId());

                        return $loginDTO;
                    }

                }

            } catch (Exception $e) {
                $e->getMessage();
                }
        }

    }

    private function googleClientInit()
    {
        $client = new Google_Client();
        $client->setApplicationName("Melomaniacs");
        $client->setClientId($this->google_client_id);
        $client->setClientSecret($this->google_secret_id);
        $client->setRedirectUri($this->google_redirect_uri);
        $client->setScopes(array($this->google_email_scope, $this->google_profile_scope));

        return $client;
    }

    private function googleServiceInit($client)
    {
        return new \Google_Service_Oauth2($client);

    }
}