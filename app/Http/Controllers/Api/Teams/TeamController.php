<?php

namespace App\Http\Controllers\Api\Teams;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeamsRequest\CreateTeamRequest;
use App\Http\Requests\TeamsRequest\EditTeamRequest;
use App\Http\Requests\TeamsRequest\JoinTeamRequest;
use App\Http\Requests\TeamsRequest\LeaveTeamRequest;
use App\Services\TeamsService;
use Illuminate\Http\Request;

class TeamController extends BaseApiController
{
    protected TeamsService $teamsService;

    public function __construct(TeamsService $teamsService)
    {
        $this->teamsService = $teamsService;
    }
    public function index($user_id)
    {
        try {
            $teams = $this->teamsService->getTeamsByUser($user_id);
            return $this->returnInfoSuccess($teams);
        } catch (\Exception $e) {
            return $this->returnInfoError($e->getMessage(), 500);
        }
    }

    public function create($user_id, CreateTeamRequest $request)
    {
        try {
            $image = $request->file('logo');
            $team = $this->teamsService->createTeam($user_id, $request->all(), $image);
            return $this->returnInfoSuccess($team);
        } catch (\Exception $e) {
            return $this->returnInfoError($e->getMessage(), 500);
        }
    }

    public function update($user_id, $team_id, EditTeamRequest $request)
    {
        try {
            $team = $this->teamsService->updateTeam($user_id, $team_id, $request->all());
            return $this->returnInfoSuccess($team);
        } catch (\Exception $e) {
            return $this->returnInfoError($e->getMessage(), 500);
        }
    }

    public function joinTeam($user_id, JoinTeamRequest $request)
    {
        try {
            $team = $this->teamsService->joinTeam($user_id, $request->all());
            return $this->returnInfoSuccess($team);
        } catch (\Exception $e) {
            return $this->returnInfoError($e->getMessage(), 500);
        }
    }

    public function leaveTeam($user_id, LeaveTeamRequest $request)
    {
        try {
            $team = $this->teamsService->leaveTeam($user_id, $request->all());
            return $this->returnInfoSuccess($team);
        } catch (\Exception $e) {
            return $this->returnInfoError($e->getMessage(), 500);
        }
    }
}
