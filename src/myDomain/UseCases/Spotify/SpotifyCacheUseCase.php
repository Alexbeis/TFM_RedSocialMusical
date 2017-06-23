<?php

namespace myDomain\UseCases\Spotify;

use Predis\Client;

class SpotifyCacheUseCase
{
    /**
     * @var SpotifyUseCase $spotifyUseCase
     */
    private $spotifyUseCase;

    /**
     * @var Client
     */
    private $client;


    public function __construct(SpotifyUseCase $spotifyUseCase, Client $client)
    {
        $this->spotifyUseCase = $spotifyUseCase;
        $this->client = $client;
    }

    public function searchSong($data)
    {
        try {
            $song = $data['song'];

            if ($this->client->exists($song)) {
                return $this->client->get($song);
            }

            $uri = $this->spotifyUseCase->searchSong($data);
//            $uri = $data['tracks']->items[0]->uri;
            $this->client->set($song, $uri);

            return $uri;

        } catch (\Exception $e) {
            return false;
        }

    }
}