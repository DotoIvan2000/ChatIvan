<?php

namespace App\Services;

use App\Repositories\FollowersRepository;
use Exception;

/**
 * Class FollowersService.
 */
class FollowersService
{
    protected FollowersRepository $followersRepository;

    public function __construct(FollowersRepository $followersRepository)
    {
        $this->followersRepository = $followersRepository;
    }
    public function getFollowers($user_id)
    {
        try {
            $followers = $this->followersRepository->getFollowers($user_id);
            return $followers;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function getFollowing($user_id)
    {
        try {
            $following = $this->followersRepository->getFollowing($user_id);
            return $following;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function follow($user_id, $data)
    {
        try {
            $follow = $this->followersRepository->follow($user_id, $data);
            return $follow;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function unfollow($user_id, $data)
    {
        try {
            $unfollow = $this->followersRepository->unfollow($user_id, $data);
            return $unfollow;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
    public function searchUsers($filter ,$user_id)
    {
        try {
            $users = $this->followersRepository->searchUsers($filter, $user_id);
            return $users;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }   
    }
}
