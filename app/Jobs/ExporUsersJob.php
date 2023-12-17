<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Services\UserService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExporUsersJob implements ShouldQueue
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
        $userService = app(UserService::class);
        $path = $userService->exportUsers($this->user);
        Notification::create([
            'user_id' => $this->user->id,
            'title' => 'Archivo de usuarios',
            'description' => 'Se ha generado el archivo de usuarios',
            'path' => $path,
        ]);
    }

    public function failed(Exception $exception)
    {
        Notification::create([
            'user_id' => $this->user->id,
            'title' => 'Archivo de usuarios',
            'description' => 'No se ha podido generar el archivo de usuarios',
            'path' => null,
        ]);
    }
}
