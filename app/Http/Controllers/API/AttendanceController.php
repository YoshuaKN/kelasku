<?php

namespace App\Http\Controllers\API;

use App\Course;
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
            $this->attendance = Attendance::where('user_id', $this->user->id)->where('course_id', $request->course_id)->orderBy('created_at', 'DESC')->get();
            return $next($request);
        });
    }

    public function getAllAttend(){
        return response()->json(['success' => $this->attendance], $this->successStatus);
    }

    public function postCreateAttend($course_id){
        if ($this->getStatusAttend($course_id) == response()->json(['success' => $this->attendMessage], $this->successStatus)) {
            return response()->json(['error' => $this->attendMessage], $this->successStatus);
        }
        $attendance = new Attendance();
        $attendance->customCreate($this->user->id, $course_id);
        return response()->json(['success' => $attendance], $this->successStatus);
    }

    public function getStatusAttend($course_id){
        $attendance = $this->attendance[0];
        if ($attendance && $attendance->alreadyAttended(Course::findOrFail($course_id), $attendance))
            return response()->json(['success' => $this->attendMessage], $this->successStatus);  
        return response()->json(['success' => $this->notAttendMessage], $this->successStatus);
    }

    public function getAllUsersAttend($course_id){
        $attendance = Attendance::where('course_id', $course_id)->where('created_at', '>', now()->subdays(6))->orderBy('created_at', 'DESC')->get();
        return response()->json(['success' => $attendance], $this->successStatus);
    }

}
