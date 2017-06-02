<?php

namespace myMelomanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PublicationController extends Controller
{
    public function viewPublicationsAction(Request $request)
    {

    }

    public function createPublicationAction(Request $request)
    {
        $message = $request->request->get('message');
        $userid = $request->getSession()->get('user');
        $result = $this->get('app.application.usescases.publication.create')->execute($userid, $message);
        $publications = $this->get('app.applicarion.usecases.publication.get')->execute($userid);

        if (!$result) {

        }

        return $this->render('homeView/homeView.html.twig',
            array(
                'publications' => $publications
            ));






    }

}