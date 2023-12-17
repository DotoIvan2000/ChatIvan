<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessagesRequest\MessageRequest;
use App\Services\MessagesService;
use Exception;
use Illuminate\Http\Request;

class MessagesController extends BaseApiController
{
    protected MessagesService $messagesService;

    public function __construct(MessagesService $messagesService)
    {
        $this->messagesService = $messagesService;
    }
    public function messages($user_id, $friend_id)
    {
        try {
            $messages = $this->messagesService->getMessages($user_id, $friend_id);
            return $this->returnInfoSuccess($messages, null, 200);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), $exception->getCode());
        }
    }

    public function sendMessage($user_id, MessageRequest $request)
    {
        try {
            $message = $this->messagesService->sendMessage($request->validated(), $user_id);
            return $this->returnInfoSuccess($message, null, 200);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), $exception->getCode());
        }
    }
}
