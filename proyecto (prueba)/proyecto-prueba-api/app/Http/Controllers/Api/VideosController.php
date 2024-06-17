<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideosCpntroller;

class VideosController extends Controller
{
 /* crear index*/ 
    public function index(){
        $videos = Videos::all();

        $data = [
            'videos' => $videos,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }

    /*buscar los videos subidos por un usuario */
    public function show($id){
        $videos = Videos::where('id_usuario', $id)->get();

        $data = [
            'videos' => $videos,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }
    /*mostrar un video por id */
    public function showVideo($id){
        $video = Videos::find($id);

        $data = [
            'video' => $video,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }
    /*funcion para guardar */
    public function store(Request $request){
        $video = Videos::create([
            'video_name' => $request->video_name,
            'description' => $request->description,
            'url' => $request->url,
            'thumbnail' => $request->thumbnail,
            'likes' => 0,
            'dislikes' => 0,
            'views' => 0,
            'id_usuario' => $request->id_usuario
        ]);

        $data = [
            'video' => $video,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }
    //funcion para subir videos 
    public function upload(Request $request)
    {
        //se verifica si se subieron los archivos del video y la imagen
        if (!$request->hasFile('file') || !$request->hasFile('thumbnail')) {
            return response()->json(['message' => 'No file uploaded'], 400);
        }
        
        //se obtiene el archivo del video y se guarda en la carpeta public/videos
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();

            $filename = pathinfo($filename, PATHINFO_FILENAME);
            $name_file = str_replace(' ', '_', $filename);

            $extension = $file->getClientOriginalExtension();

            $video = date('His') . '-' . $name_file . '.' . $extension;
            $file->move(public_path('videos'), $video);

        //se obtiene el archivo de la imagen y se guarda en la carpeta public/thumbnails
            $thumbnail = $request->file('thumbnail');
            $thumbnailname = $thumbnail->getClientOriginalName();

            $thumbnailname = pathinfo($thumbnailname, PATHINFO_FILENAME);
            $name_thumbnail = str_replace(' ', '_', $thumbnailname);

            $extension_thumbnail = $thumbnail->getClientOriginalExtension();

            $picture_thumbnail = date('His') . '-' . $name_thumbnail . '.' . $extension_thumbnail;
            $thumbnail->move(public_path('thumbnails'), $picture_thumbnail);
            
        //guardar en la base de datos la informacion del video y la ruta del video que se guardo en la carpeta public/videos
            $video = Videos::create([
                'video_name' => $request->video_name,
                'description' => $request->description,
                'url' => 'videos/'.$video,
                'thumbnail' => 'thumbnails/'.$picture_thumbnail,
                'likes' => 0,
                'dislikes' => 0,
                'views' => 0,
                'id_usuario' => $request->id_usuario
            ]);
            return response()->json(['response' => $request], 200);

    }

    /*funcion para actualizar */
    public function update(Request $request, $id){
        $video = Videos::find($id);
        $video->video_name = $request->video_name;
        $video->description = $request->description;
        $video->url = $request->url;
        $video->thumbnail = $request->thumbnail;
        $video->save();

        $data = [
            'video' => $video,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }
    /*funcion para eliminar */
    public function destroy($id){
        $video = Videos::find($id);
        $video->delete();

        $data = [
            'message' => 'Video eliminado',
            'status'=> 200
        ];
        return response()->json($data, 200);
    }
    /*funcion atualizar likes y dislikes */
    public function updateLikesDislikes($id, $likes, $dislikes){
        $video = Videos::find($id);
        $video->likes = $likes;
        $video->dislikes = $dislikes;
        $video->save();

        $data = [
            'video' => $video,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }
    /*funcion para actualizar vistas*/
    public function updateViews($id, $views){
        $video = Videos::find($id);
        $video->views = $views;
        $video->save();

        $data = [
            'video' => $video,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }
}
