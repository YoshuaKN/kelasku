<?php

namespace App\Http\Controllers\API;

use App\Kelas;
use App\Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    private $successStatus = 200;
    private $attendMessage = "You have attended in this class";
    private $notAttendMessage = "You haven't attended in this class";

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->attendance = Attendance::where('user_id', $this->user->id)->where('kelas_id', $request->kelas_id)->orderBy('created_at', 'DESC')->get();
            $this->kelas = Kelas::findOrFail($request->kelas_id);
            return $next($request);
        });
    }

    public function getAllAttend(){
        return response()->json(['success' => $this->attendance], $this->successStatus);
    }

    public function postCreateAttend($kelas_id){
        if ($this->getStatusAttend() == response()->json(['success' => $this->attendMessage], $this->successStatus)) {
            return response()->json(['error' => $this->attendMessage], $this->successStatus);
        }
        $attendance = new Attendance();
        $attendance->customCreate($this->user->id, $kelas_id);
        return response()->json(['success' => $attendance], $this->successStatus);
    }

    public function getStatusAttend(){
        $attendance = $this->attendance[0];
        if ($attendance && $attendance->alreadyAttended($this->kelas, $attendance))
            return response()->json(['success' => $this->attendMessage], $this->successStatus);  
        return response()->json(['success' => $this->notAttendMessage], $this->successStatus);
    }

    public function getAllUsersAttend($kelas_id){
        $attendance = Attendance::where('kelas_id', $kelas_id)->where('created_at', '>', now()->subdays(6))->orderBy('created_at', 'DESC')->get();
        return response()->json(['success' => $attendance], $this->successStatus);
    }

}
