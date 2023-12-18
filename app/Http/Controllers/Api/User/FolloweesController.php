<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\FollowersRequest\FollowerRequest;
use App\Services\FollowersService;
use Exception;
use Illuminate\Http\Request;

class FolloweesController extends BaseApiController
{
    protected FollowersService $followersService;

    public function __construct(FollowersService $followersService)
    {
        $this->followersService = $followersService;
    }
    public function following($user_id)
    {
        try {
            $following = $this->followersService->getFollowing($user_id);
            return $this->returnInfoSuccess($following, 200);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), 500);
        }
    }

    public function follow($user_id, FollowerRequest $request)
    {
        try {
            $follow = $this->followersService->follow($user_id, $request->validated());
            return $this->returnInfoSuccess($follow, 200);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), 500);
        }
    }

    public function unfollow($user_id, FollowerRequest $request)
    {
        try {
            $follow = $this->followersService->unfollow($user_id, $request->validated());
            return $this->returnInfoSuccess($follow, "Se ha dejado de seguir", 204);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), 500);
        }
    }

    public function searchUsers($user_id, Request $request)
    {
        $filter = $request->filter;
        try {
            $users = $this->followersService->searchUsers($filter, $user_id);
            return $this->returnInfoSuccess($users, null, 200);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), 500);
        }
    }
}
