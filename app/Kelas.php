<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = "kelas";
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'day',
        'start_time',
        'end_time',
        'owner'
    ];

    public function customCreate($request, $user)
    {
        $this->name = $request->name;
        $this->day = $request->day;
        $this->time_start = $request->time_start;
        $this->time_end = $request->time_end;
        $this->owner = $user->id;
        $this->save();
    }

    public function customUpdate($request, $user)
    {
        $this->name = $request->name;
        $this->day = $request->day;
        $this->time_start = $request->time_start;
        $this->time_end = $request->time_end;
        $this->update();
    }

    public function customDelete(){

    }

    public function user()
    {
        return $this->belongsToMany(User::class, "user_kelas", "kelas_id", "user_id");
    }

    public function attendance() {
        return $this->hasMany(Attendance::class);
    }

    public function hasUser($user)
    {
        $users = $this->user;
        foreach ($users as $value) {
            if ($value->id == $user->id) {
                return 1;
            }
        }
        return false;
    }
}
