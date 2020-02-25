<?php

namespace App\Http\Controllers\API;

use App\Course;
use App\Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    private $successStatus = 200;
    private $attendMessage = "Success attend";
    private $alreadyAttendMessage = "You have attended in this class";
    private $notAttendMessage = "You haven't attended in this class";

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->attendance = Attendance::where('user_id', Auth::user()->id)->where('course_id', $request->course_id)->orderBy('created_at', 'DESC')->get();
            return $next($request);
        });
    }

    public function getAll(){
        return response()->json(['success' => $this->attendance], $this->successStatus);
    }

    public function store($course_id){
        if ($this->getStatusAttend($course_id) == response()->json(['success' => $this->alreadyAttendMessage], $this->successStatus)) {
            return response()->json(['error' => $this->alreadyAttendMessage], $this->successStatus);
        }
        $attendance = new Attendance();
        $attendance->customCreate(Auth::user()->id, $course_id);
        return response()->json(['success' => $this->attendMessage], $this->successStatus);
    }

    public function getStatus($course_id){
        if ($this->attendance->count() != 0 && $this->attendance[0]->alreadyAttended(Course::findOrFail($course_id), $this->attendance[0]))
            return response()->json(['success' => $this->alreadyAttendMessage], $this->successStatus);  
        return response()->json(['success' => $this->notAttendMessage], $this->successStatus);
    }

    public function getUsers($course_id){
        $attendance = Attendance::where('course_id', $course_id)->where('created_at', '>', now()->subdays(6))->orderBy('created_at', 'DESC')->get();
        return response()->json(['success' => $attendance], $this->successStatus);
    }

}
