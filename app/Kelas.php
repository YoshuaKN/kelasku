<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = "kelas";	
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','day','start_time', 'end_time'
    ];

    public function user() {
        return $this->belongsToMany(User::class, "user_kelas", "kelas_id", "user_id");
    }

    // public function file() {
    //     return $this->belongsToMany(FileModel::class, "class_file", "class_id", "file_id");
    // }

    public function hasUser($user) {
        if ($this->user->contains($user)) {
            return true;
        }
        return false;
    }
}
