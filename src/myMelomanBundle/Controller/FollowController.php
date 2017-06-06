<?php

namespace myMelomanBundle\Controller;

use myDomain\DTO\FollowingDTO;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FollowController extends Controller
{
    public function followAction(Request $request)
    {
        $userid         = $request->getSession()->get('user');
        $followed       = (int)$request->get('id');
        $followingDTO   = new FollowingDTO($userid, $followed);

        $result = $this->get('app.application.usecases.follow.create')->execute($followingDTO);

        return new JsonResponse(
            array(
                "done" => $result
            )
        );
    }

    public function unfollowAction(Request $request)
    {
        $userid         = $request->getSession()->get('user');
        $followed       = (int)$request->get('id');
        $followingDTO   = new FollowingDTO($userid, $followed);

        $result = $this->get('app.application.usecases.follow.delete')->execute($followingDTO);

        return new JsonResponse(
            array(
                "done" => $result
            )
        );
    }
}