<?php

namespace myMelomanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PublicationController extends Controller
{

    public function createPublicationAction(Request $request)
    {
        $message = $request->request->get('message');
        $userid = $request->getSession()->get('user');
        $result = $this->get('app.application.usescases.publication.create')->execute($userid, $message, null);

        if (!$result) {

        }

        return $this->redirectToRoute('home');

    }

    public function createPublicationFromSpotifyAction(Request $request)
    {
        $uri =  json_decode($request->getContent(), true);
        $userid = $request->getSession()->get('user');
        $result = $this->get('app.application.usescases.publication.create')->execute($userid, null, $uri['uri']);

        if (!$result) {

        }
        return new JsonResponse(
            array(
                'url' => $this->generateUrl('home')
            )
        );

    }

    public function deletePublicationAction(Request $request, $id)
    {
        $userId = $request->getSession()->get('user');
        $result = $this->get('app.application.usescases.publication.delete')->execute($userId, $id);


        return new JsonResponse(
            array(
            'url' => $this->generateUrl('home')
            )
        );
    }

}