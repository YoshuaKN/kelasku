<?php

namespace App\Http\Controllers\API;

use App\Kelas;
use App\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    private $successStatus = 200;
    private $createMaterialMessage = "Create material success";

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function getAllMaterials($kelas_id){
        return response()->json(['success' => Material::where('course_id', $kelas_id)], $this->successStatus);
    }

    //must include $kelas_id for $material_id get the actual material id
    public function getOneMaterial($kelas_id, $material_id){
        return response()->json(['success' => Material::find($material_id)], $this->successStatus);
    }

    public function postCreateMaterial(Request $request, $kelas_id){
        $material = new Material;
        $material->customCreate($request, $kelas_id);
        return response()->json(['success' => $this->createMaterialMessage], $this->successStatus);
    }

    public function putUpdateMaterial($kelas_id, $material_id){
        return response()->json(['success' => Material::find($material_id)], $this->successStatus);
    }

    public function deleteOneMaterial($kelas_id, $material_id){
        return response()->json(['success' => Material::find($material_id)], $this->successStatus);
    }
}
