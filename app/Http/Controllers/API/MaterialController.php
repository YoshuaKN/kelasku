<?php

namespace App\Http\Controllers\API;

use App\Material;
use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    private $successStatus = 200;
    private $createMaterialMessage = "Create material success";
    private $updateMaterialMessage = "Update material success";
    private $deleteMaterialMessage = "Delete material success";

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function getAllMaterials($course_id){
        return response()->json(['success' => Material::where('course_id', $course_id)->get()], $this->successStatus);
    }

    public function getOneMaterial(Request $request){
        // Material::find($request->material_id)->file->each(function ($child) {
        //     return $child;
        // });
        // return Material::find($request->material_id)->file;
        return response()->json(['success' => Material::find($request->material_id)], $this->successStatus);
    }

    public function postCreateMaterial(MaterialRequest $request){
        $material = new Material;
        $material->customCreate($request, $request->course_id);
        return response()->json(['success' => $this->createMaterialMessage], $this->successStatus);
    }

    public function putUpdateMaterial(MaterialRequest $request){
        $material = Material::find($request->material_id);
        $material->customUpdate($request);
        return response()->json(['success' => $this->updateMaterialMessage], $this->successStatus);
    }

    public function deleteOneMaterial(Request $request){
        Material::find($request->material_id)->delete();
        return response()->json(['success' => $this->deleteMaterialMessage], $this->successStatus);
    }
}
