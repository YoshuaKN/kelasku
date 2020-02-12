<?php

namespace App\Http\Controllers\API;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller{
    private $successStatus = 200;
    private $createCourseMessage = "Create Course success";
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

    public function getAllCourse(){
        return response()->json(['success' => $this->user->Course], $this->successStatus);
    }

    public function getOneCourse($course_id){
        return response()->json(['success' => Course::findOrFail($course_id)], $this->successStatus);
    }

    public function postCreateCourse(CourseRequest $request){
        $course = new Course();
        $course->customCreate($request, $this->user);
        return response()->json(['success' => $this->createCourseMessage], $this->successStatus);
    }

    public function putUpdateCourse(CourseRequest $request, $course_id){
        $course = Course::findOrFail($course_id);
        $course->customUpdate($request, $this->user);
        return response()->json(['success' => $this->updateCourseessage], $this->successStatus);
    }

    public function deleteOneCourse($course_id){
        Course::findOrFail($course_id)->delete();
        return response()->json(['success' => $this->deleteCourseMessage], $this->successStatus);
    }

    public function getStatusCourse(){
        return response()->json(['success' => $this->CourseStatusOpenMessage], $this->successStatus);
    }

    public function getUsersCourse($course_id){
        $course = Course::findOrFail($course_id);
        return response()->json(['success' => $course->user], $this->successStatus);
    }

    public function postEnrollCourse($course_id){
        $course = Course::findOrFail($course_id);
        $course->user()->attach($this->user);
        return response()->json(['success' => $this->enrollMessage], $this->successStatus);
    }
}

    //Initialize success status code
    //This function will returns all kelas data that the user has enrolled
    /* 
    This function will return a kelas data with the given id. 

    Rules : 
        The given course_id must be in database.
        User must be enrolled in the kelas.

    Return :
         Kelas data.
    */
        /*
    This function creates a kelas with 4 form data, which is :
        name : a string with value of the kelas's name, max 255 characters.
        day : the day the kelas take palce, integer value between 0-6 (0 : Sunday, 1 : Monday, ... , 6 : Saturday).
        time_start : time when the class starts, date format [Hour:Minutes].
        time_end : time when the class ends, date format [Hour:Minutes], must be greater than the time_start.
    
    Rules : 
        Only teacher can create a kelas.

    Return : kelas data that has been created.
    */
        //Check if user is a teacher

        /* 
    This function will update the kelas data with the given id. 

    Rules : 
        The given course_id must be in database.
        Only the owner of the kelas that can update.

    Return :
        Updated kelas data.
    */
        /* 
    This function will delete the kelas data with the given id. 

    Rules : 
        The given course_id must be in database.
        Only the owner of the kelas that can update.

    Return :
        String = "Delete Success"
    */
