<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ScreenTime;
use App\Models\TimeLog;
use Illuminate\Support\Collection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ScreenTimeController extends Controller
{
   public function showAllUsersTimeSpent(Request $request)
{
    if (Session::has('LoggedIn')) {
        $user_session = User::where('id', Session::get('LoggedIn'))->first();

        // Fetch users where is_super_admin is 0
        $users = User::where('is_super_admin', 0)->get();

        // Initialize an empty array to store user time spent data
        $usersTimeSpent = new Collection();

        // Iterate through each user to calculate time spent per day, week, and total
        foreach ($users as $user) {
            $userId = $user->id;

            // Calculate time spent per day, week, and total for the current user
            $timeSpentToday = $this->timeSpentPerDay($userId);
            $timeSpentThisWeek = $this->timeSpentPerWeek($userId);
            $timeSpentTotal = $this->timeSpentTotal($userId);

            // Add user data to the collection
            $usersTimeSpent->push([
                'user' => $user,
                'timeSpentToday' => gmdate('H:i:s', $timeSpentToday),
                'timeSpentThisWeek' => gmdate('H:i:s', $timeSpentThisWeek),
                'timeSpentTotal' => gmdate('H:i:s', $timeSpentTotal),
            ]);
        }

        // Pass data to the view
        return view('admin.backend.all-users-time-spent', [
            'usersTimeSpent' => $usersTimeSpent,
        ], compact('user_session'));

    } else {
        return Redirect()->with('fail', 'You have to login first');
    }
}


    private function timeSpentPerDay($userId)
    {
        // Calculate time spent today
$today = Carbon::today();
$timeLogsToday = TimeLog::where('user_id', $userId)
    ->whereDate('start_time', $today)
    ->get();

$totalTimeToday = $timeLogsToday->sum(function ($log) {
    return $log->end_time ? $log->start_time->diffInSeconds($log->end_time) : 0;
});

return $totalTimeToday; // Return total time spent in seconds for today

    }

    private function timeSpentPerWeek($userId)
    {
        // Calculate time spent this week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $timeLogsWeek = TimeLog::where('user_id', $userId)
            ->whereBetween('start_time', [$startOfWeek, $endOfWeek])
            ->get();

        $totalTimeWeek = $timeLogsWeek->sum(function ($log) {
            return $log->end_time ? $log->start_time->diffInSeconds($log->end_time) : 0;
        });

        return $totalTimeWeek; // Return total time spent in seconds for this week
    }
    private function timeSpentTotal($userId)
{
    // Calculate total time spent
    $timeLogsTotal = TimeLog::where('user_id', $userId)->get();

    $totalTime = $timeLogsTotal->sum(function ($log) {
        return $log->end_time ? $log->start_time->diffInSeconds($log->end_time) : 0;
    });

    return $totalTime; // Return total time spent in seconds
}

    public function trackTime(Request $request)
    {
        // dd($request->json()->all());
        $data = $request->json()->all();

        // Assuming you have a ScreenTime model to save the data
        ScreenTime::create([
            'user_id' => Session::get('LoggedIn'), // Assuming you have authentication
            'url' => $data['url'],
            'product_id' => $data['productId'], // Corrected to match the sent data
            'time_spent' => $data['timeSpent']
        ]);

        return response()->json(['status' => 'success']);
    }
    public function index()
    {
        if (Session::has('LoggedIn')) {

            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            $trackedTimes = ScreenTime::with(['product', 'user'])
                ->join('users', 'screen_times.user_id', '=', 'users.id')
                ->select(
                    'screen_times.product_id',
                    'screen_times.user_id',
                    DB::raw('SUM(screen_times.time_spent) as total_time_spent'),
                    'screen_times.url' // Include the 'url' field
                )
                ->where('users.is_super_admin', 0)
                ->groupBy('screen_times.product_id', 'screen_times.user_id', 'screen_times.url') // Group by 'url' if necessary
                ->orderBy('screen_times.created_at', 'desc')
                ->get();

            $title = 'Track Time Of Products';
            return view('admin.backend.index', compact('trackedTimes', 'title', 'user_session'));
        } else {
            return Redirect()->with('fail', 'You have to login first');
        }
    }
}
