<?php

namespace App\Repositories;

use App\Models\PendingApprove;
use App\Models\Type;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class PendingApproveRepository.
 */
class PendingApproveRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return PendingApprove::class;
    }

    public function getAll()
    {
        return $this->model->with('user')->get();
    }

    public function approve($user_id)
    {
        try {
            DB::beginTransaction();
            $statusPremium = Type::whereStr('premium-account')->first();
            $user = User::where('id', $user_id)->first();
            $user->update([
                'type_id' => $statusPremium->id
            ]);
            $user->assignRole('admin');
            $this->model->where('user_id', $user_id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function disapprove($user_id)
    {
        try {
            DB::beginTransaction();
            $statusNormal = Type::whereStr('normal-account')->first();
            $user = User::where('id', $user_id)->first();
            $user->update([
                'type_id' => $statusNormal->id
            ]);
            $user->removeRole('admin');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
