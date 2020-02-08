<?php

namespace App\Http\Controllers\API;

use App\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use stdClass;

class FileController extends Controller
{
    private $successStatus = 200;
    private $createFileMessage = "Create file success";
    private $deleteFileMessage = "Delete file success";

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function getAllShareableFile(Request $request){
        $files = File::where('material_id', $request->material_id)->where('shareable', 1)->get();
        $file_links = array();
        foreach ($files as $file) {
            $f = new stdClass();
            $f->name = $file->name;
            $f->link = url()->current().'/'.$file->id;
            array_push($file_links, $f);
        }
        return response()->json(['success' => $file_links], $this->successStatus);
    }

    public function getOneFile(Request $request){
        $file = File::find($request->file_id);
        return Storage::download($file->path);
    }

    public function postUploadShareableFile(FileRequest $request){
        $path = Storage::putFile('file/course_'.$request->kelas_id.'/material_'.$request->material_id.'/shareable', $request->file('file'));

        $file = new File();
        $file->name = $request->name;
        $file->material_id = $request->material_id;
        $file->path = $path;
        $file->shareable = 1;
        $file->owner = $this->user->id;
        $file->save();

        return response()->json(['success' => $this->createFileMessage], $this->successStatus);
    }

    public function deleteOneFile(Request $request){
        $file = File::find($request->file_id);
        Storage::delete($file->path);
        $file->delete();
        return response()->json(['success' => $this->deleteFileMessage], $this->successStatus);
    }


    public function getAllSubmitFile(Request $request){
        $files = File::where('material_id', $request->material_id)->where('shareable', 0);
        if ($this->user->user_type != 'T') 
            $files = $files->where('owner', $this->user->id);
            
        $files = $files->get();
        $file_links = array();
        foreach ($files as $file) {
            $f = new stdClass();
            $f->name = $file->name;
            $f->link = url()->current().'/'.$file->id;
            array_push($file_links, $f);
        }
        return response()->json(['success' => $file_links], $this->successStatus);
    }

    public function postUploadSubmitFile(FileRequest $request){
        $path = Storage::putFile('file/course_'.$request->kelas_id.'/material_'.$request->material_id.'/submit', $request->file('file'));

        $file = new File();
        $file->name = $request->name;
        $file->material_id = $request->material_id;
        $file->path = $path;
        $file->shareable = 0;
        $file->owner = $this->user->id;
        $file->save();

        return response()->json(['success' => $this->createFileMessage], $this->successStatus);
    }
}
