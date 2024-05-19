<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //check_in
    public function check_in(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $attendances  = new Attendance();
        $attendances->user_id = $request->user()->id;
        $attendances->date = date('Y-m-d');
        $attendances->time_in = date('H:i:s');
        $attendances->latlon_in = $request->latitude . ',' . $request->longitude;
        $attendances->save();

        return response()->json([
            'message' => 'Checkin successful',
            'attendance' => $attendances
        ], 200);
    }

    public function check_out(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $attendances = Attendance::where('user_id', $request->user()->id)->where('date', date('Y-m-d'))->first();

        if (!$attendances) {
            return response()->json(['message' => 'Checkin First'], 400);
        }


        $attendances->time_out = date('H:i:s');
        $attendances->latlon_out = $request->latitude . ',' . $request->longitude;
        $attendances->save();

        return response()->json([
            'message' => 'Checkout successful',
            'attendance' => $attendances
        ], 200);
    }

    //check is checkout successful
    public function is_checkin(Request $request)
    {
        $attendances = Attendance::where('user_id', $request->user()->id)->where('date', date('Y-m-d'))->first();


        return response()->json([
            'checkedin' => $attendances ? true : false,
        ], 200);
    }
}
