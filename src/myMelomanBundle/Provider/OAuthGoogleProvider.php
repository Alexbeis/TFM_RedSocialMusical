<?php

namespace myMelomanBundle\Provider;

use myDomain\OAuthGoogleProviderInterface;

class OAuthGoogleProvider implements OAuthGoogleProviderInterface
{
    /**
     * @var \Google_Service
     */
    private $googleService;

    public function __construct(\Google_Service_Oauth2 $googleService)
    {
        $this->googleService = $googleService;
    }

    public function createURL()
    {
        return $this->googleService->getClient()->createAuthUrl();

    }
    public function getAccessToken()
    {
        return $this->googleService->getClient()->getAccessToken();
    }

    public function setAccessToken($token)
    {
        $this->googleService->getClient()->setAccessToken($token);

    }
    public function getUserEmail()
    {
        return $this->googleService->userinfo->get()->getEmail();

    }
    public function getUserName()
    {
        return $this->googleService->userinfo->get()->getFamilyName();

    }
    public  function getPictureUrl()
    {
        return $this->googleService->userinfo->get()->getPicture();
    }

    public function authenticate($code) {

        $this->googleService->getClient()->authenticate($code);
    }

}