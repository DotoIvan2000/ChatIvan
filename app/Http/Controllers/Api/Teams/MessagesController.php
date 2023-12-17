<?php

namespace App\Http\Controllers\Api\Teams;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessagesRequest\TeamMessageRequest;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function sendMessage($user_id, TeamMessageRequest $request)
    {
        //
    }
}
