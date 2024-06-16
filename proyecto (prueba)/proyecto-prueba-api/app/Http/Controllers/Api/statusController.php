<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Status;

class statusController extends Controller
{
public function store(Request $request){
    $status = Status::create([
        'id_video' => $request->id_video,
        'id_usuario' => $request->id_usuario,
        'status' => $request->status
    ]);

    $data = [
        'styleconfig' => $status,
        'status'=> 200
    ];
    return response()->json($data, 200);
}
/*funcion para actualizar*/ 

public function update(Request $request, $id){
    $status = Status::find($id);
    $status->id_video = $request->id_video;
    $status->id_usuario = $request->id_usuario;
    $status->status = $request->status;
    $status->save();

    $data = [
        'styleconfig' => $status,
        'status'=> 200
    ];
    return response()->json($data, 200);
}
/*funcion para mostrar si un usuario dio like o dislike a un video */
public function show($id_video, $id_usuario){
    $status = Status::where('id_video', $id_video)->where('id_usuario', $id_usuario)->first();

    $data = [
        'styleconfig' => $status,
        'status'=> 200
    ];
    return response()->json($data, 200);
}

/*contar la cantidad de likes */
public function countLikes($id){
    $likes = Status::where('id_video', $id)->where('status', 1)->count();
    $data = [
        'likes' => $likes,
        'status'=> 200
    ];
    return response()->json($data, 200);
}
/*contar la cantidad de dislikes */
public function countDislikes($id){
    $dislikes = Status::where('id_video', $id)->where('status', 0)->count();
    $data = [
        'dislikes' => $dislikes,
        'status'=> 200
    ];
    return response()->json($data, 200);
}


/*funcion para eliminar todos los campos dado el id de un video*/
public function destroy($id){
    $status = Status::where('id_video', $id)->delete();
    $data = [
        'message' => 'Status eliminado',
        'status'=> 200
    ];
    return response()->json($data, 200);
}
/*funcion para eliminar un campo dado el id de un usuario*/
public function destroyUser($id){
    $status = Status::where('id_usuario', $id)->delete();
    $data = [
        'message' => 'Status eliminado',
        'status'=> 200
    ];
    return response()->json($data, 200);
}
}