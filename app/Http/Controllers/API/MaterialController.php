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
    private $updateMaterialMessage = "Update material success";
    private $deleteMaterialMessage = "Delete material success";

    public function getAll($course_id){
        return response()->json(['success' => Material::where('course_id', $course_id)->get()], $this->successStatus);
    }

    public function show(Request $request){
        return response()->json(['success' => Material::find($request->material_id)], $this->successStatus);
    }

    public function store(MaterialRequest $request){
        $material = new Material;
        $material->customCreate($request, $request->course_id);
        return response()->json(['success' => $material], $this->successStatus);
    }

    public function update(MaterialRequest $request){
        $material = Material::find($request->material_id);
        $material->customUpdate($request);
        return response()->json(['success' => $this->updateMaterialMessage], $this->successStatus);
    }

    public function destroy(Request $request){
        Material::find($request->material_id)->delete();
        return response()->json(['success' => $this->deleteMaterialMessage], $this->successStatus);
    }
}
