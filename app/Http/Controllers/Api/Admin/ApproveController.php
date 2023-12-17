<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApproveRequest\ApproveRequest;
use App\Services\PendingApproveService;
use Exception;
use Illuminate\Http\Request;

class ApproveController extends BaseApiController
{
    protected PendingApproveService $pendigApproveService;

    public function __construct(PendingApproveService $pendigApproveService)
    {
        $this->pendigApproveService = $pendigApproveService;
    }

    public function index()
    {
        try {
            $allPendingApproves = $this->pendigApproveService->getAll();
            return $this->returnInfoSuccess($allPendingApproves, null, 200);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), 500);
        }
    }

    public function approve(ApproveRequest $request)
    {
        try {
            $this->pendigApproveService->approve($request->user_id);
            return $this->returnInfoSuccess(null, 'Aprobado correctramente', 200);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), 500);
        }
    }

    public function disapprove(Request $request)
    {
        try {
            $this->pendigApproveService->disapprove($request->user_id);
            return $this->returnInfoSuccess(null, 'Desaprobado correctramente', 200);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), 500);
        }
    }
}
