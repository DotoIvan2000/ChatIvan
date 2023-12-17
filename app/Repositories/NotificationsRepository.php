<?php

namespace App\Repositories;

use App\Models\Notification;
use Exception;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class NotificationsRepository.
 */
class NotificationsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Notification::class;
    }
    public function notifications($id)
    {
        try {
            $notifications = $this->model->where('user_id', $id)->get();
            return $notifications;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }
}
