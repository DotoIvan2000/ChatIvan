<?php

namespace App\Repositories;

use App\Models\Message;
use Exception;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class MessagesRepository.
 */
class MessagesRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Message::class;
    }

    public function getMessages($user_id, $friend_id)
    {
        try {
            return Message::totalMessages($user_id, $friend_id)
                ->with('sender', 'receiver')
                ->orderBy('created_at', 'asc')
                ->get();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }

    public function createMessage($data, $user_id)
    {
        try {
            return Message::create([
                'sender_id' => $user_id,
                'receiver_id' => $data['receptor_id'],
                'message' => $data['message'],
            ]);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }
}
