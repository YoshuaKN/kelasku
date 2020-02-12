<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "course";
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'day',
        'start_time',
        'end_time',
        'owner'
    ];

    public function customCreate($request, $user){
        $this->name = $request->name;
        $this->day = $request->day;
        $this->time_start = $request->time_start;
        $this->time_end = $request->time_end;
        $this->owner = $user->id;
        $this->save();
    }

    public function customUpdate($request){
        $this->name = $request->name;
        $this->day = $request->day;
        $this->time_start = $request->time_start;
        $this->time_end = $request->time_end;
        $this->update();
    }

    private function numToDay($num){
        $dayNames = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
        return $dayNames[$num];
    }

    public function isOpen(){
        if ($this->numToDay($this->day) == date('D') && $this->time_start <= date('H:i') && $this->time_end >= date('H:i')) {
            return true;
        }
        return false;
    }

    public function user(){
        return $this->belongsToMany(User::class, "user_course", "course_id", "user_id");
    }

    public function attendance() {
        return $this->hasMany(Attendance::class);
    }

    public function material() {
        return $this->hasMany(Material::class);
    }

    public function hasUser($user){
        $users = $this->user;
        foreach ($users as $value) {
            if ($value->id == $user->id) {
                return 1;
            }
        }
        return false;
    }
}
