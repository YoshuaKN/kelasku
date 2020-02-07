<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = "material";
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'course_id',
    ];

    public function customCreate($request, $course_id){
        $this->course_id = $course_id;
        $this->name = $request->name;
        $this->description = $request->description;
        $this->save();
    }

    public function customUpdate($request){
        $this->name = $request->name;
        $this->description = $request->description;
        $this->update();
    }

    public function course() {
        return $this->belongsTo(Kelas::class);
    }
}
