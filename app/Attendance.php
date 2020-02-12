<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = "attendance";	
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'course_id'
    ];

    public function customCreate($user_id, $course_id){
        $this->user_id = $user_id;
        $this->course_id = $course_id;
        $this->save();
    }   

    public function alreadyAttended($course){
        $now = date('Ymd');
        $time_attendance_before = date('YmdHi', strtotime($this->created_at));
        $time_start = $now.date('Hi', strtotime($course->time_start));
        $time_end = $now.date('Hi', strtotime($course->time_end));
        if ($time_attendance_before >= $time_start && $time_attendance_before <= $time_end) {
            return true;
        }
        return false;
    }
}
