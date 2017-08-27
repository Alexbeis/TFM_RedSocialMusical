<?php

namespace myMelomanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class NotificationController extends Controller
{
    public function getUserNotificationsAction(Request $request)
    {
        $userId = (int) $request->query->get('id');
        $notifications = $this->get('app.application.usecases.notification.get')->execute($userId);

        return $this->render(
            'Notifications/notificationsView.html.twig',
            array(
                'notifications' => $notifications
            )
        );

    }

    public function getCountUserNotificationsAction(Request $request, $id)
    {
        $userId = (int) $id;
        $notifications = $this->get('app.application.usecases.notification.get')->execute($userId);

        return new JsonResponse(
            array(
                'nCount' => count($notifications)
            )
        );
    }

    public function markNotificationsAsReadAction(Request $request, $id)
    {

        $result = $this->get('app.application.usecases.notification.mark_as_read')->execute((int) $id);
        return new JsonResponse(
            array(
                'updateCount' => $result,
                'not_id' => $id
            )
        );

    }

}