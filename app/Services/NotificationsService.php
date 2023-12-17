<?php

namespace App\Services;

use App\Repositories\NotificationsRepository;
use Exception;

/**
 * Class NotificationsService.
 */
class NotificationsService
{
    protected NotificationsRepository $notificationsRepository;

    public function __construct(NotificationsRepository $notificationsRepository)
    {
        $this->notificationsRepository = $notificationsRepository;
    }
    public function notifications($id)
    {
        try {
            $notifications = $this->notificationsRepository->notifications($id);
            return $notifications;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }
}
