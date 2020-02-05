<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Validator;

class KelasController extends Controller
{
    //Initialize success status code
    public $successStatus = 200;

    //This init function checks whether the kelas exists in the database and whether the user has access to that class
    public function init($user, $kelas)
    {
        //Checking existence of kelas
        if (!$kelas) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        //Check if user have access by using a function isInKelas
        if (!$this->isInKelas($user, $kelas->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return NULL;
    }

    //This function checks whether the user has access in kelas
    private function isInKelas($user, $kelas_id){
        if (Kelas::find($kelas_id)->hasUser($user))
            return true;
        return false;
    }

    //This function will returns all kelas data that the user has enrolled
    public function getAllKelas()
    {
        $user = Auth::user();
        $kelas = $user->kelas;
        return response()->json(['success' => $kelas], $this->successStatus);
    }

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
    public function postCreateKelas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'day' => 'required|integer|between:0,6',
            'time_start' => 'date_format:H:i',
            'time_end' => 'date_format:H:i|after:time_start',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = Auth::user();

        //Check if user is a teacher
        if ($user->user_type != 'T') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $kelas = new Kelas();
        $kelas->name = $request->name;
        $kelas->day = $request->day;
        $kelas->time_start = $request->time_start;
        $kelas->time_end = $request->time_end;
        $kelas->owner = $user->id;
        $kelas->save();

        $kelas->user()->attach($user);

        return response()->json(['success' => $kelas], $this->successStatus);
    }

    /* 
    This function will return a kelas data with the given id. 

    Rules : 
        The given kelas_id must be in database.
        User must be enrolled in the kelas.

    Return :
        Kelas data.
    */
    public function getOneKelas($kelas_id)
    {
        $user = Auth::user();

        if (!$this->isInKelas($user, $kelas_id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $kelas = Kelas::find($kelas_id);

        if (!$kelas) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        return response()->json(['success' => $kelas], $this->successStatus);
    }

    /* 
    This function will update the kelas data with the given id. 

    Rules : 
        The given kelas_id must be in database.
        Only the owner of the kelas that can update.

    Return :
        Updated kelas data
    */
    public function putUpdateKelas(Request $request, $kelas_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'day' => 'integer|between:0,6',
            'time_start' => 'date_format:H:i',
            'time_end' => 'date_format:H:i',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = Auth::user();
        $kelas = Kelas::find($kelas_id);
        
        $check = $this->init($user, $kelas);
        if ($check) {
            return $check;
        }

        //Check the owner of the given kelas.
        if ($kelas->owner != $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($request->name != NULL)
            $kelas->name = $request->name;
        if ($request->day != NULL)
            $kelas->day = $request->day;
        if ($request->time_start != NULL)
            $kelas->time_start = $request->time_start;
        if ($request->time_end != NULL) {
            if ($request->time_end <= $kelas->time_start) {
                return response()->json(['error' => "time_end must bigger than time_start", 'time_start' => $kelas->time_start, 'time_end' => $request->time_end], 401);
            }
            $kelas->time_end = $request->time_end;
        }
        $kelas->update();

        return response()->json(['success' => $kelas], $this->successStatus);
    }
    /* 
    This function will delete the kelas data with the given id. 

    Rules : 
        The given kelas_id must be in database.
        Only the owner of the kelas that can update.

    Return :
        String = "Delete Success"
    */
    public function deleteOneKelas($kelas_id)
    {
        $user = Auth::user();
        $kelas = Kelas::find($kelas_id);
        
        $check = $this->init($user, $kelas);
        if ($check) {
            return $check;
        }

        if ($kelas->owner != $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $kelas->user()->detach();
        $kelas->delete();

        return response()->json(['success' => "Delete success"], $this->successStatus);
    }
}
