<?php

namespace App\Http\Middleware;

use App\Models\TimeLog;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class InactivityTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $lastActivity = Session::get('last_activity');
        $timeout = config('session.lifetime') * 60; // Convert minutes to seconds

        if ($lastActivity && (time() - $lastActivity) > $timeout) {
            $userId = Session::get('LoggedIn');
            $data = User::find($userId);
            if ($data) {
                $data->update(['is_online' => 0, 'last_seen' => Carbon::now()]);

                // Log the logout time
                $lastTimeLog = TimeLog::where('user_id', 34)->latest()->first();
                if ($lastTimeLog) {
                    $lastTimeLog->end_time = Carbon::now();
                    $lastTimeLog->save();
                }
            }

            Session::forget('LoggedIn');
            return redirect('https://bikebros.net/')->with('success', 'Tu sesión ha caducado por inactividad.');
        }

        // Update last activity timestamp
        Session::put('last_activity', time());


    return $next($request);
    }
}
