<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Services\TeamsService;
use Exception;
use Illuminate\Http\Request;

class TeamController extends BaseApiController
{
    protected $teamService;

    public function __construct(TeamsService $teamService)
    {
        $this->teamService = $teamService;
    }
    public function index($user_id)
    {
        $teams = $this->teamService->getTeams();
        return $this->returnInfoSuccess($teams, null, 200);
    }

    public function deleteteam($user_id, $id)
    {
        try {
            $team = $this->teamService->deleteTeam($id);
            return $this->returnInfoSuccess($team, null, 200);
        } catch (Exception $exception) {
            return $this->returnInfoError($exception->getMessage(), 500);
        }
    }
}
