<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    private $successStatus = 200;
    private $createMaterialMessage = "Create material success";

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            Kelas::findOrFail($request->kelas_id);
            return $next($request);
        });
    }

    public function getAllMaterials($kelas_id){
        return response()->json(['success' => Material::where('course_id', $kelas_id)], $this->successStatus);
    }

    public function postCreateMaterial(Request $request, $kelas_id){
        $material = new Material;
        $material->customCreate($request, $kelas_id);
        return response()->json(['success' => $this->createMaterialMessage], $this->successStatus);
    }
}
