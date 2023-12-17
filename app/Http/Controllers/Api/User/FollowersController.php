<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseApiController;
use App\Services\FollowersService;
use Exception;
use Illuminate\Http\Request;

class FollowersController extends BaseApiController
{
    protected FollowersService $followersService;

    public function __construct(FollowersService $followersService)
    {
        $this->followersService = $followersService;
    }

    public function followers($user_id)
    {
        try {
            $followers = $this->followersService->getFollowers($user_id);
            return $this->returnInfoSuccess($followers, 200);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), 500);
        }
    }
}
