<?php

namespace App\Services;

use App\Repositories\PendingApproveRepository;

/**
 * Class PendingApproveService.
 */
class PendingApproveService
{
    protected PendingApproveRepository $pendigApproveRepository;

    public function __construct(PendingApproveRepository $pendigApproveRepository)
    {
        $this->pendigApproveRepository = $pendigApproveRepository;
    }
    public function getAll()
    {
        return $this->pendigApproveRepository->getAll();
    }

    public function approve($user_id)
    {
        try {
            $this->pendigApproveRepository->approve($user_id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function disapprove($user_id)
    {
        try {
            $this->pendigApproveRepository->disapprove($user_id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
