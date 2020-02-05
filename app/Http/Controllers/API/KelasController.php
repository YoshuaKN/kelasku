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
    public $successStatus = 200;

    public function getAllKelas(){
        $user = Auth::user();
        $kelas = $user->kelas;
        // foreach ($kelas as $c) {
        //     $userkelas = UserAndkelasModel::where("user_id", $user->id)->where("kelas_id", $c->id)->get()[0];
        //     $absent = AbsentModel::where("user_kelas_id", $userkelas->id)->where("created_at", '>', now()->subDays(6))->first();
        //     $attendance = false;
        //     if ($absent) {
        //         $attendance = true;
        //     }
        //     $c->attendance = $attendance;
        // }
        return response()->json(['success'=>$kelas], $this->successStatus);
    }

    public function postCreateKelas(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'day' => 'required|integer|between:1,7',
            'time_start' => 'date_format:H:i',
            'time_end' => 'date_format:H:i|after:time_start',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        
        $user = Auth::user();

        if ($user->user_type != 'T') {
            return response()->json(['error'=>'You don\'t have access'], 403);   
        }
        $kelas = new Kelas();
        $kelas->name = $request->name;
        $kelas->day = $request->day;
        $kelas->time_start = $request->time_start;
        $kelas->time_end = $request->time_end;
        $kelas->save();

        $kelas->user()->attach($user);

        return response()->json(['success'=>$kelas], $this->successStatus);
    }

    public function getOneKelas($kelas_id){
        $user = Auth::user();
        
        if (!Kelas::find($kelas_id)->hasUser($user)) {
            return response()->json(['error'=>'You don\'t have access'], 403);
        }

        $kelas = Kelas::find($kelas_id);
        return response()->json(['success'=>$kelas], $this->successStatus);
    }
}
