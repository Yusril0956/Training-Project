<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\UserRole;
use App\Models\Training;

class isMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if admin or super admin
        // if ($user->hasAnyRole(['Admin', 'Super Admin'])->exists()){
        if ($user->roles()->whereIn('name', ['Admin', 'Super Admin'])->exists()) {
            return $next($request);
        }

        // Get training id from route
        $trainingId = $request->route('id') ?? $request->route('name') ?? $request->route('trainingId');

        if (!$trainingId) {
            abort(403, 'Training ID not found');
        }

        // If name is not numeric, assume it's training name, find id
        if (!is_numeric($trainingId)) {
            $training = Training::where('name', $trainingId)->first();
            if ($training) {
                $trainingId = $training->id;
            } else {
                abort(404, 'Training not found');
            }
        }

        $isMember = \App\Models\TrainingMember::whereHas('trainingDetail', function ($q) use ($trainingId) {
            $q->where('training_id', $trainingId);
        })->where('user_id', $user->id)->exists();

        if (!$isMember) {
            return redirect()->route('training.register', $trainingId);
        }

        return $next($request);
    }
}
