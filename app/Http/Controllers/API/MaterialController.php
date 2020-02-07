<?php

namespace App\Http\Controllers\API;

use App\Material;
use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialRequest;
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

    public function getAllMaterials($kelas_id){
        return response()->json(['success' => Material::where('course_id', $kelas_id)->get()], $this->successStatus);
    }

    //must include $kelas_id for $material_id get the actual material id
    public function getOneMaterial($kelas_id, $material_id){
        return response()->json(['success' => Material::find($material_id)], $this->successStatus);
    }

    public function postCreateMaterial(MaterialRequest $request, $kelas_id){
        $material = new Material;
        $material->customCreate($request, $kelas_id);
        return response()->json(['success' => $this->createMaterialMessage], $this->successStatus);
    }

    public function putUpdateMaterial(MaterialRequest $request, $kelas_id, $material_id){
        $material = Material::find($material_id);
        $material->customUpdate($request);
        return response()->json(['success' => $this->updateMaterialMessage], $this->successStatus);
    }

    public function deleteOneMaterial($kelas_id, $material_id){
        Material::find($material_id)->delete();
        return response()->json(['success' => $this->deleteMaterialMessage], $this->successStatus);
    }
}
