<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest\LoginRequest;
use App\Http\Requests\AuthRequest\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;

class AuthController extends BaseApiController
{
    protected UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function register(RegisterRequest $request)
    {
        try {
            $validateData = $request->validated();
            $data = $this->userService->createUser($validateData);
            return $this->returnInfoSuccess($data, null, 201);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $validateData = $request->validated();
            $data = $this->userService->loginUser($validateData);
            return $this->returnInfoSuccess($data, null, 200);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $this->userService->logoutUser($request->user_id);
            return $this->returnInfoSuccess(null, 'Se cerro sesion correcamente', 200);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), 500);
        }
    }
}
