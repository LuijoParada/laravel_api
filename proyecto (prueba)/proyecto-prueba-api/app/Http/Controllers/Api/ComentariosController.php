<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Comentarios;
use App\Models\Usuarios;

class ComentariosController extends Controller
{
    public function index()
    {
        $comments = Comentarios::all();
        $data = [
            'comentarios' => $comments,
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    public function show($id)
    {
        $comment = Comentarios::find($id);

        if ($comment){
            $data = [
                'comentario' => $comment,
                'status' => 200
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Comentario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
    }

    public function showFromVideo($videoId) {
        $comments = Comentarios::where('id_video', $videoId)->get();
        $data = [
            'comentarios' => $comments,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_video' => 'required',
            'id_usuario' => 'required',
            'comentario' => 'required'
        ]);

        if ($validator->fails()){
            $errors = $validator->errors();
            $data = [
                'message' => 'Error en la validacion del comentario: '.$errors,
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $comment = Comentarios::create([
            'id_video' => $request->id_video,
            'id_usuario' => $request->id_usuario,
            'comentario' => $request->comentario
        ]);

        if ($comment){
            $data = [
                'message' => 'Comentario creado correctamente',
                'status' => 201
            ];
            return response()->json($data, 201);
        } else {
            $data = [
                'message' => 'Error al crear el comentario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar un recurso existente
    }

    public function destroy($id)
    {
        $comment = Comentarios::find($id);

        if(!$comment){
            $data = [
                'message' => 'Comentario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $comment->delete();
        $data = [
            'message' => 'Comentario eliminado',
            'status' => 200
        ];
    }
}
