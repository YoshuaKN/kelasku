<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = "attendance";	
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'kelas_id'
    ];
}
