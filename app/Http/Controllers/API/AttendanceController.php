<?php

namespace App\Http\Controllers\API;

use App\Kelas;
use App\Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public $successStatus = 200;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });

        return "asd";
    }

    private function userAttendanceList($kelas_id){
        $attendance = Attendance::where('user_id', $this->user->id)
                                ->where('kelas_id', $kelas_id)
                                ->get();
        return $attendance;
    }

    public function getAllAttend($kelas_id){
        if (!Kelas::findOrFail($kelas_id)->hasUser($this->user)) 
            return response()->json(['error' => 'Unauthorized'], 403);

        $attendance = $this->userAttendanceList($kelas_id);

        return response()->json(['success' => $attendance], $this->successStatus);
    }

    public function getStatusAttend($kelas_id){
        $kelas = Kelas::findOrFail($kelas_id);
        
        if (!Kelas::findOrFail($kelas_id)->hasUser($this->user)) 
            return response()->json(['error' => 'Unauthorized'], 403);

        $attendance = $this->userAttendanceList($kelas_id)[0];
        if ($attendance && $attendance->alreadyAttended($kelas, $attendance)) {
            return response()->json(['success' => "You have attended in this class"], $this->successStatus);
        }
            
        return response()->json(['success' => "You haven't attended in this class"], $this->successStatus);
    }

    public function postCreateAttend($kelas_id){
        $kelas = Kelas::findOrFail($kelas_id);

        if (!Kelas::findOrFail($kelas_id)->hasUser($this->user)) 
            return response()->json(['error' => 'Unauthorized'], 403);

        if ($kelas->isOpen()) {
            $attendance = $this->userAttendanceList($kelas_id)[0];
            if ($attendance && $attendance->alreadyAttended($kelas, $attendance)) {
                return response()->json(['error' => "You have attended in this class"], $this->successStatus);
            }

            $attendance = new Attendance();
            $attendance->customCreate($this->user->id, $kelas_id);

            return response()->json(['success' => $attendance], $this->successStatus);
        } 

        return response()->json(['error' => "Kelas hasn't opened yet"], 403);
    }

}
