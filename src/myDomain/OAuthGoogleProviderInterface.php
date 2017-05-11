<?php


namespace myDomain;


interface OAuthGoogleProviderInterface
{
    public function createURL();
    public function getAccessToken();
    public function setAccessToken($token);
    public function getUserEmail();
    public function getUserName();

}