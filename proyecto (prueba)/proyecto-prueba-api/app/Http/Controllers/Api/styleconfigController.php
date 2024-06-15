<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Styleconfig;

class styleconfigController extends Controller
{
    /*funcion para mostrar */
    public function index(){
        $styleconfig = Styleconfig::all();

        $data = [
            'styleconfig' => $styleconfig,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }

    /*funcion para guardar */
    public function store(Request $request){
        $styleconfig = Styleconfig::create([
            'primaryColor' => $request->primaryColor,
            'secondaryColor' => $request->secondaryColor,
            'tertiaryColor' => $request->tertiaryColor,
            'titleColor' => $request->titleColor,
            'subtitleColor' => $request->subtitleColor,
            'pColor' => $request->pColor,
            'bgBtnColor' => $request->bgBtnColor,
            'texBtnColor' => $request->texBtnColor
        ]);

        $data = [
            'styleconfig' => $styleconfig,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }
    /*funcion para mostrar el guardado mas reciente por fecha*/ 
    public function showLast(){
        $styleconfig = Styleconfig::latest()->first();

        $data = [
            'styleconfig' => $styleconfig,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }
    
    /*funcion para mostrar por id */
    public function show($id){
        $styleconfig = Styleconfig::find($id);

        $data = [
            'styleconfig' => $styleconfig,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }
}
 