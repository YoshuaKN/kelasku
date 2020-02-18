<?php

namespace App\Http\Controllers\API;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller{
    private $successStatus = 200;
    private $deleteCourseMessage = "Delete Course success";
    private $updateCourseessage = "Update Course success";
    private $enrollMessage = "Enroll success";
    private $CourseStatusOpenMessage = "Course has been opened";

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function getAll(){
        return response()->json(['success' => $this->user->Course], $this->successStatus);
    }

    public function show($course_id){
        return response()->json(['success' => Course::findOrFail($course_id)], $this->successStatus);
    }

    public function store(CourseRequest $request){
        $course = new Course();
        $course->customCreate($request, $this->user);
        return response()->json(['success' => $course], $this->successStatus);
    }

    public function update(CourseRequest $request, $course_id){
        $course = Course::findOrFail($course_id);
        $course->customUpdate($request, $this->user);
        return response()->json(['success' => $this->updateCourseessage], $this->successStatus);
    }

    public function destroy($course_id){
        Course::findOrFail($course_id)->delete();
        return response()->json(['success' => $this->deleteCourseMessage], $this->successStatus);
    }

    public function enroll($course_id){
        $course = Course::findOrFail($course_id);
        $course->user()->attach($this->user);
        return response()->json(['success' => $this->enrollMessage], $this->successStatus);
    }

    public function getStatus(){
        return response()->json(['success' => $this->CourseStatusOpenMessage], $this->successStatus);
    }

    public function getUsers($course_id){
        $course = Course::findOrFail($course_id);
        return response()->json(['success' => $course->user], $this->successStatus);
    }
}