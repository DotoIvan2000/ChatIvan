<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Services\TeamsService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExporTeamsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    public $tries = 3;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $teamsService = app(TeamsService::class);
        $path = $teamsService->exportTeams($this->user);
        Notification::create([
            'user_id' => $this->user->id,
            'title' => 'Archivo de equipos',
            'description' => 'Se ha generado el archivo de equipos',
            'path' => $path,
        ]);
    }

    public function failed(Exception $exception)
    {
        Notification::create([
            'user_id' => $this->user->id,
            'title' => 'Archivo de equipos',
            'description' => 'No se ha podido generar el archivo de equipos',
            'path' => null,
        ]);
    }
}
