<?php

namespace myDomain\UseCases\Spotify;

use SpotifyWebAPI;

class SpotifyUseCase
{
    private $spotifySession;
    private $spotifyClientId;
    private $spotifySecretId;
    private $spotifyWebApi;

    public function __construct($spotifyClientId, $spotifySecretId)
    {
        $this->spotifyClientId = $spotifyClientId;
        $this->spotifySecretId = $spotifySecretId;
        $this->spotifyWebApi   = new SpotifyWebAPI\SpotifyWebAPI();
        $this->spotifySession  = new SpotifyWebAPI\Session($this->spotifyClientId,$this->spotifySecretId);

        $this->spotifySession->requestCredentialsToken();
        $accessToken = $this->spotifySession->getAccessToken();

        $this->spotifyWebApi->setAccessToken($accessToken);
        
    }

    public function searchSong($data)
    {
        $song   = $data['song'];
        $result =  (array)$this->spotifyWebApi->search($song, array("track"), array('limit'=>5, 'offset'=>0));

        $uri    = $result['tracks']->items[0]->uri;

        return $uri;

    }

}