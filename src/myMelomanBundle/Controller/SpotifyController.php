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

        $spotifyUseCase = $this->get('app.application.usecases.spotify.cache')->searchSong($data);

        if (!$spotifyUseCase) {

            $notFound = $this->renderView(
                'homeView/notFound.html.twig',
                array(
                    'data' => $data['song']
                )
            );

            return new JsonResponse(
                array(
                    'done' => false,
                    'errorView' => $notFound
                )
            );
        }
        $view = $this->renderView(
            'homeView/spotifyPlayer.html.twig',
             array(
                 'uri' => $spotifyUseCase
             )
        );

        return new JsonResponse(
            array(
                'done' => true,
                'view' => $view
            )
        );
    }
}