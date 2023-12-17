<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Services\NotificationsService;
use Exception;
use Illuminate\Http\Request;

class NotificationsController extends BaseApiController
{
    protected NotificationsService $notificationsService;
    public function __construct(NotificationsService $notificationsService)
    {
        $this->notificationsService = $notificationsService;
    }

    public function notifications($id)
    {
        try {
            $notifications = $this->notificationsService->notifications($id);
            return $this->returnInfoSuccess($notifications, null, 200);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), $exception->getCode());
        }
    }
}
