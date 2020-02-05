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

    public function init($user, $kelas)
    {
        if (!$kelas) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        if (!$this->isInKelas($user, $kelas->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        return NULL;
    }
    
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

    private function isAttandanced ($kelas, $attendance, $returnType = "success"){
        $now = date('Ymd');
        $time_attendance_before = date('YmdHi', strtotime($attendance->created_at));
        $time_start = $now.date('Hi', strtotime($kelas->time_start));
        $time_end = $now.date('Hi', strtotime($kelas->time_end));
        if ($time_attendance_before >= $time_start && $time_attendance_before <= $time_end) {
            return response()->json([$returnType => "You are already present in this class"], $this->successStatus);
        }
    }

    private function isInKelas($user, $kelas_id){
        if (Kelas::find($kelas_id)->hasUser($user))
            return true;
        return false;
    }

    public function postCreateAttend($kelas_id){
        $user = Auth::user();
        $kelas = Kelas::find($kelas_id);

        $check = $this->init($user, $kelas);
        if ($check) {
            return $check;
        }

        if ($this->isKelasOpen($kelas)) {
            $attendance = Attendance::where('user_id', $user->id)->where('kelas_id', $kelas_id)->first();
            if ($attendance) {
                $check = $this->isAttandanced($kelas, $attendance, "error");
                if ($check) {
                    return $check;
                }
            }

            $attendance = new Attendance();
            $attendance->user_id = $user->id;
            $attendance->kelas_id = $kelas_id;
            $attendance->save();
            return response()->json(['success' => $attendance], $this->successStatus);
        } 

        return response()->json(['error' => "Kelas hasn't opened yet"], 403);
    }

    public function getStatusKelas($kelas_id){
        $user = Auth::user();
        $kelas = Kelas::find($kelas_id);
        
        $check = $this->init($user, $kelas);
        if ($check) {
            return $check;
        }

        if ($this->isKelasOpen($kelas)) {
            return response()->json(['success' => "open"], $this->successStatus);
        } else {
            return response()->json(['success' => "close"], $this->successStatus);
        }
    }

    public function getAllAttend($kelas_id){
        $user = Auth::user();
        $kelas = Kelas::find($kelas_id);
        
        $check = $this->init($user, $kelas);
        if ($check) {
            return $check;
        }

        $attendance = Attendance::where('user_id', $user->id)->where('kelas_id', $kelas_id)->get();

        return response()->json(['success' => $attendance], $this->successStatus);
    }

    public function getStatusAttend($kelas_id){
        $user = Auth::user();
        $kelas = Kelas::find($kelas_id);
        
        $check = $this->init($user, $kelas);
        if ($check) {
            return $check;
        }

        $attendance = Attendance::where('user_id', $user->id)->where('kelas_id', $kelas_id)->first();
        if (!$attendance) {
            return response()->json(['success' => "You are not present in this class"], $this->successStatus);
        }

        $check = $this->isAttandanced($kelas, $attendance);
        if ($check) {
            return $check;
        }
            
        return response()->json(['success' => "You are not present in this class"], $this->successStatus);
    }
}
