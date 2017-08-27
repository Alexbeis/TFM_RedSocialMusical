<?php

namespace myDomain;

use myDomain\Entity\Notification;

interface NotificationRepositoryInterface
{
    public function create(Notification $otification);
    public function remove(Notification $notification);

}