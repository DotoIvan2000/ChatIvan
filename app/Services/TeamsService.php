<?php

namespace App\Services;

use App\Exports\ExportTeams;
use App\Repositories\TeamsRepository;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class TeamsService.
 */
class TeamsService
{
    protected $teamsRepository;
    public function __construct(TeamsRepository $teamsRepository)
    {
        $this->teamsRepository = $teamsRepository;
    }

    public function exportTeams()
    {
        try {
            $teams = $this->teamsRepository->allTeams();
            $fileName = 'teams_' . now()->format('YmdHis') . '.xlsx';
            Excel::store(new ExportTeams($teams), $fileName, 'public');
            $pathToFile = Storage::disk('public')->url($fileName);
            return $pathToFile;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function getTeams()
    {
        try {
            $teams = $this->teamsRepository->allTeams();
            return $teams;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function deleteTeam($team_id)
    {
        try {
            $team = $this->teamsRepository->deleteTeam($team_id);
            return $team;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function getTeamsByUser($user_id)
    {
        try {
            $teams = $this->teamsRepository->getTeamsByUser($user_id);
            return $teams;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
    public function createTeam($user_id, $data, $image)
    {
        try {
            $aleatoryName = Str::random(10);
            $url = $image->storeAs('logos', $aleatoryName . '.' . $image->getClientOriginalExtension(), 'public');
            $team = $this->teamsRepository->createTeam($data, $url);
            $team->users()->attach($user_id);
            return $team;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
    public function updateTeam($user_id, $team_id, $data)
    {
        try {
            $team = $this->teamsRepository->findTeam($team_id);
            $team->name = $data['name'];
            $team->save();
            return $team;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function joinTeam($user_id, $data)
    {
        try {
            $team = $this->teamsRepository->findTeam($data['team_id']);
            $team->users()->attach($user_id);
            return $team;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function leaveTeam($user_id, $data)
    {
        try {
            $team = $this->teamsRepository->findTeam($data['team_id']);
            $team->users()->detach($user_id);
            return $team;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
