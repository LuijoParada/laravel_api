<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuario = Usuarios::all();

        
        $data = [
            'usuarios' => $usuario,
            'status'=> 200
        ];
                

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:tabla_usuarios',
            'password' => 'required',
            'cedula' => 'sometimes|required|unique:tabla_usuarios', // Conditional unique validation
            'tlf' => 'sometimes|required|unique:tabla_usuarios',
            'direccion' => 'sometimes|required',
            'estado' => 'sometimes|required',
            'ciudad' => 'sometimes|required',
            'nacimiento' => 'sometimes|required'
        ]);

        if($validator->fails()){
            //obtengo el mensaje de error del validator
            $errors = $validator->errors();
            $data = [
                'message' => 'Error en la validacion de el usuario'.$errors,
                'status'=> 400
            ];
            return response()->json($data, 400);
        }
        $usuario = Usuarios::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => $request->password,
            'cedula' => $request->cedula, // Only set if provided
            'tlf' => $request->tlf ,// Only set if provided
            'direccion' => $request->direccion,// Only set if provided
            'estado' => $request->estado, // Only set if provided
            'ciudad' => $request->ciudad, // Only set if provided
            'nacimiento' => $request->nacimiento // Only set if provided
        ]);

        if(!$usuario){
            $data = [
                'message' => 'Error al crear el usuario',
                'status'=> 500
            ];
            return response()->json($data, 500);
        }
        $data = [
            'usuario' => $usuario,
            'status'=> 201
        ];
        return response()->json($data, 201);
    }

    public function show($id)
    {
        $usuario = Usuarios::find($id);
        if(!$usuario){
            $data = [
                'message' => 'Usuario no encontrado',
                'status'=> 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'usuario' => $usuario,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $usuario = Usuarios::find($id);
        if(!$usuario){
            $data = [
                'message' => 'Usuario no encontrado',
                'status'=> 404
            ];
            return response()->json($data, 404);
        }
        $usuario->delete();
        $data = [
            'message' => 'Usuario eliminado',
            'status'=> 200
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuarios::find($id);
        if(!$usuario){
            $data = [
                'message' => 'Usuario no encontrado',
                'status'=> 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:tabla_usuarios,email,'.$usuario->id, // Conditional unique validation
            'cedula' => 'sometimes|required|unique:tabla_usuarios,cedula,'.$usuario->id, // Conditional unique validation
            'tlf' => 'sometimes|required|unique:tabla_usuarios,tlf,'.$usuario->id,
            'direccion' => 'sometimes|required',
            'estado' => 'sometimes|required',
            'ciudad' => 'sometimes|required',
            'nacimiento' => 'sometimes|required'

        ]);

        if($validator->fails()){
            //obtengo el mensaje de error del validator
            $errors = $validator->errors();
            $data = [
                'message' => 'Error en la validacion de el usuario'.$errors,
                'status'=> 400
            ];
            return response()->json($data, 400);
        }
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->email =$request->email ;
        $usuario->password = $request->password;
        $usuario->cedula = $request->cedula; // Only set if provided
        $usuario->tlf = $request->tlf ;// Only set if provided
        $usuario->direccion = $request->direccion;// Only set if provided
        $usuario->estado = $request->estado; // Only set if provided
        $usuario->ciudad = $request->ciudad; // Only set if provided
        $usuario->nacimiento = $request->nacimiento; // Only set if provided
        $usuario->save();
        $data = [
            'message' => 'Usuario actualizado',
            'usuario' => $usuario,
            'status'=> 200
        ];
        return response()->json($data, 200);

    }
    public function updatePartial(Request $request, $id)
    {
        $usuario = Usuarios::find($id);
        if(!$usuario){
            $data = [
                'message' => 'Usuario no encontrado',
                'status'=> 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required',
            'apellido' => 'sometimes|required',
            'password' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:tabla_usuarios,email,'.$usuario->id, // Conditional unique validation
            'cedula' => 'sometimes|required|unique:tabla_usuarios,cedula,'.$usuario->id, // Conditional unique validation
            'tlf' => 'sometimes|required|unique:tabla_usuarios,tlf,'.$usuario->id,
            'direccion' => 'sometimes|required',
            'estado' => 'sometimes|required',
            'ciudad' => 'sometimes|required',
            'nacimiento' => 'sometimes|required'
        ]);

        if($validator->fails()){
            //obtengo el mensaje de error del validator
            $errors = $validator->errors();
            $data = [
                'message' => 'Error en la validacion de el usuario'.$errors,
                'status'=> 400
            ];
            return response()->json($data, 400);
        }

        if($request->has('nombre')){
            $usuario->nombre = $request->nombre;
        }
        if($request->has('apellido')){
            $usuario->apellido = $request->apellido;
        }
        if($request->has('email')){
            $usuario->email = $request->email;
        }
        if($request->has('password')){
            $usuario->password = $request->password;
        }
        if($request->has('cedula')){
            $usuario->cedula = $request->cedula;
        }
        if($request->has('tlf')){
            $usuario->tlf = $request->tlf;
        }
        if($request->has('direccion')){
            $usuario->direccion = $request->direccion;
        }
        if($request->has('estado')){
            $usuario->estado = $request->estado;
        }
        if($request->has('ciudad')){
            $usuario->ciudad = $request->ciudad;
        }
        if($request->has('nacimiento')){
            $usuario->nacimiento = $request->nacimiento;
        }
        $usuario->save();
        $data = [
            'message' => 'Usuario actualizado', 
            'usuario' => $usuario,  
            'status'=> 200
        ];
        return response()->json($data, 200);
    }
    // crear funcion que al dar correo y contraseña devuelva el usuario

        public function login(Request $request){
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);
    
            if($validator->fails()){
                //obtengo el mensaje de error del validator
                $errors = $validator->errors();
                $data = [
                    'message' => 'Error en la validacion de el usuario'.$errors,
                    'status'=> 400
                ];
                return response()->json($data, 400);
            }
            $usuario = Usuarios::where('email', $request->email)->where('password', $request->password)->first();
        //    dd($request);
        
            if(!$usuario){
                $data = [
                    'message' => 'Usuario no encontrado',
                    'status'=> 404
                ];
                return response()->json($data, 404);
            }
            $data = [
                'usuario' => $usuario,
                'status'=> 200
            ];
            return response()->json($data, 200);
        }
}