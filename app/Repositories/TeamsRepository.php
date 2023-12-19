<?php

namespace App\Repositories;

use App\Models\Team;
use App\Models\TeamMessage;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class TeamsRepository.
 */
class TeamsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Team::class;
    }

    public function allTeams()
    {
        try {
            return $this->model->select('id', 'name', 'description', 'logo', 'str', 'created_at', 'updated_at')->get();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
    public function deleteTeam($team_id)
    {
        try {
            $team = $this->model->find($team_id);
            $team->delete();
            return $team;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
    public function getTeamsByUser($user_id)
    {
        Log::info($user_id);
        try {
            $teams = $this->model->join('team_user', 'teams.id', '=', 'team_user.team_id')
                ->where('team_user.user_id', $user_id)
                ->select('teams.id', 'teams.name', 'teams.description', 'teams.str','teams.logo', 'teams.created_at', 'teams.updated_at')
                ->get();
            return $teams;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
    public function createTeam($data, $url)
    {
        try {
            $team = $this->model->create([
                'name' => $data['name'],
                'description' => $data['description'],
                'str' => Str::lower(str_replace(' ', '_', $data['name'])),
                'logo' => $url,
            ]);
            return $team;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
    public function findTeam($team_id)
    {
        try {
            $team = $this->model->find($team_id);
            return $team;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function getMessages($team_id)
    {
        try {
            $messages = TeamMessage::where('team_id', $team_id)
                ->join('users', 'users.id', '=', 'team_messages.sender_id')
                ->select(
                    'team_messages.id',
                    'team_messages.message',
                    'team_messages.created_at',
                    'users.first_name',
                    'users.last_name',
                    'users.email',
                    'users.username',
                    'users.id as user_id',
                )
                ->get();
            return $messages;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
