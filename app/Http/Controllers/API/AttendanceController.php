<?php

namespace App\Http\Controllers\API;

use App\Attendance;
use App\Http\Controllers\Controller;
use App\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public $successStatus = 200;

    private function numToDay($num){
        $dayNames = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
        return $dayNames[$num];
    }

    private function isKelasOpen ($kelas){
        if ($this->numToDay($kelas->day) == date('D') && $kelas->time_start <= date('H:i') && $kelas->time_end >= date('H:i')) {
            return true;
        }
        return false;
    }

    private function isInKelas($user, $kelas_id){
        if (Kelas::find($kelas_id)->hasUser($user))
            return true;
        return false;
    }

    public function postCreateAttendance($kelas_id){
        $user = Auth::user();

        if (!$this->isInKelas($user, $kelas_id)) {
            return response()->json(['error' => 'You don\'t have access'], 403);
        }

        $kelas = Kelas::find($kelas_id);

        if (!$kelas) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        if ($this->isKelasOpen($kelas)) {
            
            $attendance = Attendance::where('user_id', $user->id)->where('kelas_id', $kelas_id)->first();
            $now = date('Ymd');
            $time_attendance_before = date('YmdHi', strtotime($attendance->created_at));
            $time_start = $now.date('Hi', strtotime($kelas->time_start));
            $time_end = $now.date('Hi', strtotime($kelas->time_end));
            if ($time_attendance_before >= $time_start && $time_attendance_before <= $time_end) {
                return response()->json(['error' => "You already attendance"], 403);
            }

            $attendance = new Attendance();
            $attendance->user_id = $user->id;
            $attendance->kelas_id = $kelas_id;
            $attendance->save();
            return response()->json(['success' => $attendance], $this->successStatus);
        } 

        return response()->json(['error' => "Kelas hasn't opened yet"], 403);
    }
}
