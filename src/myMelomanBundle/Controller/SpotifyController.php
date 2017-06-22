<?php

namespace myMelomanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SpotifyController extends Controller
{
    public function searchSongAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $spotifyUseCase = $this->get('app.application.usecases.spotify')->searchSong($data);

        $uri = $spotifyUseCase['tracks']->items[0]->uri;

        $view = $this->renderView(
            'homeView/spotifyPlayer.html.twig',
             array(
                 'uri' => $uri
             )
        );

        return new JsonResponse(
            array(
                'view' => $view
            )
        );
    }
}