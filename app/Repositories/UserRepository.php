<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }

    public function createUser($validateData)
    {
        try {
            DB::beginTransaction();
            $user = $this->model->create($validateData);
            DB::commit();
            return $user;
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    public function retrunUser($validateData)
    {
        try {
            $user = $this->model->where('email', $validateData['email'])->first();
            return $user;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function find($id)
    {
        try {
            $user = $this->model->find($id);
            return $user;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function allUsers()
    {
        try {
            $users = $this->model->select(
                'id',
                'first_name',
                'last_name',
                'username',
                'email',
                'created_at',
                'updated_at'
            )->get();
            return $users;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = $this->model->find($id);
            $user->delete();
            return $user;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
