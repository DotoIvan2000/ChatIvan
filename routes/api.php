<?php

use App\Http\Controllers\Api\Admin\ExportController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Admin\ApproveController;
use App\Http\Controllers\Api\Admin\TeamController;
use App\Http\Controllers\Api\Teams\TeamController as TeamsTeamController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Cards\CardController;
use App\Http\Controllers\Api\User\FolloweesController;
use App\Http\Controllers\Api\User\FollowersController;
use App\Http\Controllers\Api\User\MessagesController;
use App\Http\Controllers\Api\Teams\MessagesController as TeamsMessagesController;
use App\Http\Controllers\Api\User\NotificationsController;
use App\Http\Middleware\CheckStatus;
use App\Http\Middleware\SuperAdminMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('/admin/{user_id}')->group(function () {
    Route::group(['middleware' => ['auth:api', SuperAdminMiddleware::class]], function () {
        Route::get('/approves', [ApproveController::class, 'index'])->name('approve.index');
        Route::post('/approve-account', [ApproveController::class, 'approve'])->name('approve.approve');
        Route::post('/disapprove', [ApproveController::class, 'disapprove'])->name('disapprove');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
        Route::delete('/deleteteam/{id}', [TeamController::class, 'deleteteam'])->name('deleteteam');
        Route::delete('/deleteuser/{id}', [UserController::class, 'deleteuser'])->name('deleteuser');
        Route::prefix('/export')->group(function () {
            Route::get('/users/{user_id}', [ExportController::class, 'exportUsers'])->name('export.users');
            Route::get('/teams/{user_id}', [ExportController::class, 'exportTeams'])->name('export.teams');
        });
    });
});

Route::prefix('/user/{user_id}')->group(function () {
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/notifications', [NotificationsController::class, 'notifications'])->name('notifications');
        Route::get('/followers', [FollowersController::class, 'followers'])->name('followers');
        Route::get('/following', [FolloweesController::class, 'following'])->name('following');
        Route::get('/messages/{user_2_id}', [MessagesController::class, 'messages'])->name('messages');
        Route::post('/send-message-normal', [MessagesController::class, 'sendMessage'])->name('send.message');
        Route::post('/follow', [FolloweesController::class, 'follow'])->name('follow');
        Route::post('/unfollow', [FolloweesController::class, 'unfollow'])->name('unfollow');
        Route::post('/register-card', [CardController::class, 'registerCard'])->name('register.card');
    });
});

Route::prefix('/team/{user_id}')->group(function () {
    Route::group(['middleware' => ['auth:api', CheckStatus::class]], function () {
        Route::get('/teams', [TeamsTeamController::class, 'index'])->name('teams.index');
        Route::post('/create', [TeamsTeamController::class, 'create'])->name('team.create');
        Route::put('/update/{team_id}', [TeamsTeamController::class, 'update'])->name('team.update');
        Route::post('/join', [TeamsTeamController::class, 'joinTeam'])->name('team.join');
        Route::post('/leave', [TeamsTeamController::class, 'leaveTeam'])->name('team.leave');
        Route::post('/send-message-team', [TeamsMessagesController::class, 'sendMessage'])->name('send.message');
    });
});
