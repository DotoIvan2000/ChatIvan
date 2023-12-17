<?php

namespace App\Services;

use App\Exports\ExportUsers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class UserService
{
    protected UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function createUser($validateData)
    {
        try {
            $validateData['password'] = Hash::make($validateData['password']);
            $user = $this->userRepository->createUser($validateData);
            $accessToken = $user->createToken('Token Name')->accessToken;
            return [
                'user' => $user,
                'access_token' => $accessToken,
            ];
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function loginUser($validateData)
    {
        try {
            $user = $this->userRepository->retrunUser($validateData);
            if (!$user || !Hash::check($validateData['password'], $user->password)) {
                throw new Exception('Correo electrónico o contraseña incorrectos');
            }
            $accessToken = $user->createToken('authToken')->accessToken;
            return [
                'user' => $user,
                'access_token' => $accessToken,
            ];
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function logoutUser($id)
    {
        $user = $this->userRepository->find($id);
        try {
            $user->tokens()->delete();
            return $user;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function exportUsers()
    {
        try {
            $users = $this->userRepository->allUsers();
            $fileName = 'users_' . now()->format('YmdHis') . '.xlsx';
            Excel::store(new ExportUsers($users), $fileName, 'public');
            $pathToFile = Storage::disk('public')->url($fileName);
            return $pathToFile;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function findUser($id)
    {
        try {
            $user = $this->userRepository->find($id);
            return $user;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function getUsers()
    {
        try {
            $users = $this->userRepository->allUsers();
            return $users;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = $this->userRepository->deleteUser($id);
            return $user;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
