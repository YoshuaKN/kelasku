<?php

namespace App\Http\Controllers\API;

use App\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    public function getAllFileLinks($files){
        $file_links = array();
        foreach ($files as $file) {
            array_push($file_links, $file->getFile());
        }
        return $file_links;
    }

    public function getOneFile(Request $request){
        $file = File::find($request->file_id);
        return Storage::download($file->path, $file->name);
    }

    public function deleteOneFile(Request $request){
        File::find($request->file_id)->delete();
        return response()->json(['success' => $this->deleteFileMessage], $this->successStatus);
    }

    public function getAllShareableFile(Request $request){
        $files = File::where('material_id', $request->material_id)->where('shareable', 1)->get();
        return response()->json(['success' => $this->getAllFileLinks($files)], $this->successStatus);
    }

    public function getAllSubmitFile(Request $request){
        $files = File::where('material_id', $request->material_id)->where('shareable', 0);
        if ($this->user->user_type != 'T') 
            $files = $files->where('owner', $this->user->id);
        $files = $files->get();
        return response()->json(['success' => $this->getAllFileLinks($files)], $this->successStatus);
    }

    public function postUploadShareableFile(FileRequest $request){
        $path = Storage::putFile('file/course_'.$request->kelas_id.'/material_'.$request->material_id.'/shareable', $request->file('file'));
        $file = new File();
        $file->customCreate($request, $this->user, $path, 1);
        return response()->json(['success' => $this->createFileMessage], $this->successStatus);
    }

    public function postUploadSubmitFile(FileRequest $request){
        $path = Storage::putFile('file/course_'.$request->kelas_id.'/material_'.$request->material_id.'/submit', $request->file('file'));
        $file = new File();
        $file->customCreate($request, $this->user, $path, 0);
        return response()->json(['success' => $this->createFileMessage], $this->successStatus);
    }
}
