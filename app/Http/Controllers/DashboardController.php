<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    //index
    public function index()
    {
        $usersCount = User::count();
        $today = Carbon::today(); // Get today's date
        $attendances = User::with(['attendances' => function ($query) use ($today) {
            $query->whereDate('date', $today);
        }])->get()->filter(function ($user) {
            return $user->attendances->isEmpty();
        });
        $attendancesCount = Attendance::whereDate('date', $today)->count();
        $permissionApproved = Permission::where('is_approved', true);
        $permissionNotApproved = Permission::with('user')
            ->where('is_approved', false)
            ->get();

        return view('pages.dashboard.index', ['usersCount' => $usersCount, 'attendancesCount' => $attendancesCount, 'attendances' => $attendances, 'permissionApproved' => $permissionApproved, 'permissionNotApproved' => $permissionNotApproved]);
    }
}
