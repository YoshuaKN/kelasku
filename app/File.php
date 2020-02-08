<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use stdClass;

class File extends Model
{
    protected $table = "file";
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'path',
        'shareable',
        'owner'
    ];

    public function customCreate($request, $user, $path, $shareable){
        $this->name = $request->name;
        $this->material_id = $request->material_id;
        $this->path = $path;
        $this->shareable = $shareable;
        $this->owner = $user->id;
        $this->save();
    }

    public function getFile(){
        $file = new stdClass();
        $file->name = $this->name;
        $file->link = url()->current().'/'.$this->id;
        return $file;
    }
}
