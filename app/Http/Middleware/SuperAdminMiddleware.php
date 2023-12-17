<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->route('user_id');
        $user = User::find($userId);
        if ($user && $user->hasRole('super-admin-role')) {
            return $next($request);
        }
        return response()->json([
            'data' => null,
            'message' => 'No tienes permiso para realizar esta acción',
        ], 403);
    }
}
