<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\KelasRequest;
use App\Kelas;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    //Initialize success status code
    private $successStatus = 200;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    //This function will returns all kelas data that the user has enrolled
    public function getAllKelas()
    {
        $kelas = $this->user->kelas;
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
        if (!Kelas::findOrFail($kelas_id)->hasUser($this->user)) 
            return response()->json(['error' => 'Unauthorized'], 403);
        
        $kelas = Kelas::findOrFail($kelas_id);

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
    public function postCreateKelas(KelasRequest $request)
    {
        //Check if user is a teacher
        if ($this->user->user_type != 'T') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $kelas = new Kelas();
        $kelas->customCreate($request, $this->user);

        return response()->json(['success' => $kelas], $this->successStatus);
    }

    /* 
    This function will update the kelas data with the given id. 

    Rules : 
        The given kelas_id must be in database.
        Only the owner of the kelas that can update.

    Return :
        Updated kelas data.
    */
    public function putUpdateKelas(KelasRequest $request, $kelas_id)
    {
        $kelas = Kelas::findOrFail($kelas_id);

        if (!$kelas->hasUser($this->user) || $kelas->owner != $this->user->id) 
            return response()->json(['error' => 'Unauthorized'], 403);

        $kelas = Kelas::findOrFail($kelas_id);

        $kelas->customUpdate($request, $this->user);
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
        $kelas = Kelas::findOrFail($kelas_id);

        if (!$kelas->hasUser($this->user) || $kelas->owner != $this->user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $kelas->delete();

        return response()->json(['success' => "Delete success"], $this->successStatus);
    }
}
