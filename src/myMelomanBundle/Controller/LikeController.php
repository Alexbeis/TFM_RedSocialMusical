<?php

namespace myMelomanBundle\Controller;

use myDomain\DTO\LikeDTO;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LikeController extends Controller
{
    public function likeAction($id, Request $request)
    {
        $userId     = $request->getSession()->get('user');
        $pubId      = (int)$id;
        $likeDTO    = new LikeDTO($userId, $pubId);
        $result     = $this->get('app.application.usescases.publication.like')->execute($likeDTO);

        if ($result) {
            $this->getDoctrine()->getManager()->flush();
        }

        return new JsonResponse(
            array(
                'done' => true
            )
        );


    }

    public function dislikeAction($id ,Request $request)
    {
        $userId     = $request->getSession()->get('user');
        $pubId      = (int)$id;
        $likeDTO    = new LikeDTO($userId, $pubId);
        $result     = $this->get('app.application.usescases.publication.dislike')->execute($likeDTO);

        if ($result) {
            $this->getDoctrine()->getManager()->flush();
        }

        return new JsonResponse(
            array(
                'done' => true
            )
        );


    }

}