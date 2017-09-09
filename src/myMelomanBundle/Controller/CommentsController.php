<?php

namespace myMelomanBundle\Controller;

use myDomain\DTO\CommentDTO;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CommentsController extends Controller
{
    public function createCommentAction(Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $message = $content['message'];
        $pubId   = (int) $content['pub'];
        $userId  = $request->getSession()->get('user');

        $commentDTO = new CommentDTO($userId, $pubId, $message);
        $result = $this->get('app.application.usecases.comments.create')->execute($commentDTO);

        if (!$result->isResult()) {
            return new JsonResponse(
                array(
                    'done' => $result->isResult(),
                    'message' => 'Cannot save the comment'
                )
            );
        }
        $comments = $this->get('app.application.usecases.get_specific_publication_comments')->execute($pubId);
        $view = $this->renderView('/homeView/commentsView.html.twig',
            array(
                'comments' =>  $comments
            )
        );
        return new JsonResponse(
            array(
                'done' => $result->isResult(),
                'view' => $view
            )
        );


    }

}