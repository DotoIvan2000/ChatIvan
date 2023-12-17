<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;

class UserController extends BaseApiController
{
    protected $usersService;

    public function __construct(UserService $usersService)
    {
        $this->usersService = $usersService;
    }
    public function index($user_id)
    {
        try {
            $users = $this->usersService->getUsers();
            return $this->returnInfoSuccess($users, null, 200);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), 500);
        }
    }

    public function deleteuser($user_id, $id)
    {
        try {
            $user = $this->usersService->deleteUser($id);
            return $this->returnInfoSuccess($user, null, 200);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), 500);
        }
    }
}
