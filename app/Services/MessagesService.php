<?php

namespace App\Services;

use App\Repositories\MessagesRepository;
use Exception;

/**
 * Class MessagesService.
 */
class MessagesService
{
    protected MessagesRepository $messagesRepository;
    public function __construct(MessagesRepository $messagesRepository)
    {
        $this->messagesRepository = $messagesRepository;
    }
    public function getMessages($user_id, $friend_id)
    {
        try {
            $messages = $this->messagesRepository->getMessages($user_id, $friend_id);
            return $messages;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }

    public function sendMessage($data ,$user_id)
    {
        try {
            $message = $this->messagesRepository->createMessage($data, $user_id);
            return $message;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }
}
