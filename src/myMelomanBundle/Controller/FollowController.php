<?php

namespace myMelomanBundle\Controller;

use myDomain\DTO\FollowingDTO;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FollowController extends Controller
{
    public function followAction(Request $request)
    {
        $userid         = $request->getSession()->get('user');
        $followed       = (int)$request->get('id');
        $followingDTO   = new FollowingDTO($userid, $followed);

        $result = $this->get('app.application.usecases.follow.create')->execute($followingDTO);
        $notResult = $this->get('app.application.usecases.notification.create')->execute($followed, 'follow', $userid);

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

    public function showFollowingUsersAction(Request $request, $id)
    {
        $result = $this->get('app.application.usecases.get.users.following')->execute($id);

        return $this->render('userView/followingView.html.twig',
            array(
                'followings' => $result,
                'type' => 'following'
            )
        );
    }

    public function showFollowerUsersAction(Request $request, $id)
    {
        $result = $this->get('app.application.usecases.get.users.followers')->execute($id);

        return $this->render('userView/followingView.html.twig',
            array(
                'followings' => $result,
                'type' => 'follower'
            )
        );

    }

    public function showUserPublicationsAction(Request $request, $id)
    {
        $result = $this->get('app.application.usecases.publication.specific.user.get')->execute($id);

        return $this->render('homeView/userPublications.html.twig',
            array(
                'publications' => $result
            )
        );

    }

    public function showUserLikesAction(Request $request, $id)
    {
        $result = $this->get('app.application.usecases.get.user.likes')->execute($id);

        return $this->render('Likes/likesView.html.twig',
            array(
                'likes' => $result
            )
        );
    }
}