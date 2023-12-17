<?php

namespace App\Repositories;

use App\Models\Follower;
use App\Models\User;
use Exception;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class FollowersRepository.
 */
class FollowersRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Follower::class;
    }

    public function getFollowers($user_id)
    {
        try {
            return $this->model->where('followee_id', $user_id)
                ->with('follower')
                ->get();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function getFollowing($user_id)
    {
        try {
            return $this->model->where('follower_id', $user_id)
                ->with('followee')
                ->get();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function follow($user_id, $data)
    {
        try {
            $follow = $this->model->create([
                'follower_id' => $user_id,
                'followee_id' => $data['followee_id']
            ]);
            return $follow;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function unfollow($user_id, $data)
    {
        try {
            $unfollow = $this->model->where('follower_id', $user_id)
                ->where('followee_id', $data['followee_id'])
                ->delete();
            return $unfollow;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
