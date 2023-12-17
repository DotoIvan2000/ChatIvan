<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Jobs\ExporTeamsJob;
use App\Jobs\ExporUsersJob;
use App\Services\UserService;
use Illuminate\Http\Request;

class ExportController extends BaseApiController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function exportUsers($user_id)
    {
        $user = $this->userService->findUser($user_id);
        ExporUsersJob::dispatch($user);
        return $this->returnInfoSuccess(null, 'Se esta generando el archivo, espere notificacion', 200);
    }

    public function exportTeams($user_id)
    {
        $user = $this->userService->findUser($user_id);
        ExporTeamsJob::dispatch($user);
        return $this->returnInfoSuccess(null, 'Se esta generando el archivo, espere notificacion', 200);
    }
}
