<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Kelas;
use App\Http\Controllers\Controller;
use App\Http\Requests\KelasRequest;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller{
    private $successStatus = 200;
    private $createKelasMessage = "Create kelas success";
    private $deleteMessage = "Delete success";
    private $enrollMessage = "Enroll success";
    private $kelasStatusOpenMessage = "Kelas has been opened";

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function getAllKelas(){
        return response()->json(['success' => $this->user->kelas], $this->successStatus);
    }

    public function getOneKelas($kelas_id){
        return response()->json(['success' => Kelas::findOrFail($kelas_id)], $this->successStatus);
    }

    public function postCreateKelas(KelasRequest $request){
        $kelas = new Kelas();
        $kelas->customCreate($request, $this->user);
        return response()->json(['success' => $this->createKelasMessage], $this->successStatus);
    }

    public function putUpdateKelas(KelasRequest $request, $kelas_id){
        $kelas = Kelas::findOrFail($kelas_id);
        $kelas->customUpdate($request, $this->user);
        return response()->json(['success' => $kelas], $this->successStatus);
    }

    public function deleteOneKelas($kelas_id){
        Kelas::findOrFail($kelas_id)->delete();
        return response()->json(['success' => $this->deleteMessage], $this->successStatus);
    }

    public function getStatusKelas(){
        return response()->json(['success' => $this->kelasStatusOpenMessage], $this->successStatus);
    }

    public function getUsersKelas($kelas_id){
        $kelas = Kelas::findOrFail($kelas_id);
        return response()->json(['success' => $kelas->user], $this->successStatus);
    }

    public function postEnrollKelas($kelas_id){
        $kelas = Kelas::findOrFail($kelas_id);
        $kelas->user()->attach($this->user);
        return response()->json(['success' => $this->enrollMessage], $this->successStatus);
    }
}

    //Initialize success status code
    //This function will returns all kelas data that the user has enrolled
    /* 
    This function will return a kelas data with the given id. 

    Rules : 
        The given kelas_id must be in database.
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
        The given kelas_id must be in database.
        Only the owner of the kelas that can update.

    Return :
        Updated kelas data.
    */
        /* 
    This function will delete the kelas data with the given id. 

    Rules : 
        The given kelas_id must be in database.
        Only the owner of the kelas that can update.

    Return :
        String = "Delete Success"
    */
