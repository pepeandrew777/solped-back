<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroRequest;
use App\Models\User;
use App\Models\Menu;
use App\Models\RoleUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\ApiController;
use Exception;

class AuthController extends ApiController
{
   // protected $username = 'v_usuario';
    public function registro(RegistroRequest $request)
    {
        $username = $this->crear_username($request['apellido_paterno'],$request['nombres']);
        $email = User::where('v_email', $request['email'])->first();
        if($email)
        {
            $response['status'] = 0;
            $response['message'] = 'Correo Electronico ya registrado previamente ';
            $response['code'] = 409;
        }
        else
        {
            $usuario = User::create([
                'v_nombres' => $request->nombres,
                'v_usuario' => $username,
                'v_apellido_paterno' => $request->apellido_paterno,
                'v_apellido_materno' => $request->apellido_materno,
//                'v_cargo' => $request->cargo,
                'v_ci' => $request->ci,
                'v_email' => $request->email,
                'n_id_departamento' => $request->id_departamento,
                'v_password' => Hash::make($request->password),
            ]);
            $rolusuario = new RoleUsuario();
            $rolusuario->n_id_rol = $request->input('rol');
            $usuario->rolusuario()->save($rolusuario);
            $response['status'] = 1;
            $response['message'] = 'Usuario registrado Exitosamente! ';
            $response['code'] = 200;
        }

        return response()->json($response);
    }

    function crear_username($paterno, $nombre)
    {
        $letra = substr($nombre, 0, 1);
        $username = strtolower($paterno.$letra);
        $usuario = User::where('v_usuario', $username)->first();
        if($usuario)
        {
            $arr_nombre = explode(" ", $nombre);
            if (count($arr_nombre) > 1)
            {
                $letra = substr($arr_nombre[1], 0, 1);
                $username = strtolower($username.$letra);
                $usuario = User::where('v_usuario', $username)->first();
                if($usuario)
                {
                    $username = strtolower($paterno.substr($arr_nombre[0], 0, 2).substr($arr_nombre[1], 0, 1));
                    return $username;
                }
                else
                {
                    return $username;
                }
            }
            else
            {
                $letra = substr($nombre, 1, 1);
                $username = strtolower($username.$letra);
                $usuario = User::where('v_usuario', $username)->first();
                if($usuario)
                {
                    $username = strtolower($paterno.substr($arr_nombre[0], 0, 3));
                    return $username;
                }
                else
                {
                    return $username;
                }
                return $username;
            }
        }
        else
        {
            return $username;
        }
    }

    public function login(Request $request)
    {  
        if(!Auth::attempt(['v_usuario' => $request->usuario, 'password' => $request->password]))        
        {
            $response['status'] = 0;
            $response['code'] = 401;
            $response['data'] = null;
            $response['message'] = 'Credenciales NO válidas';

            return response()->json($response);
        }

            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
    
            $cookie = cookie('jwt', $token, 60*2);
    
            return \response([
                'jwt' => $token,
                'status'=> 1,
                'code' => 200,                
                'message' => 'Login exitoso, BIENVENIDO !!'
            ])->withCookie($cookie);
       
    }

    public function user(Request $request)
    {
        $usuario = $request->user();
        $rol = RoleUsuario::join('at_roles','at_roles.n_id_rol','=','at_rol_usuario.n_id_rol')
        ->where('at_rol_usuario.n_id','=', $usuario['n_id'])
        ->first();
        $usuario['rol'] = $rol;
        return $usuario;
//        return $request->user();
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');
        return \response([
            'message' => 'success'
        ])->withCookie($cookie);
    }

    public function listar_usuarios()
    {        
//       $usuarios = User::withTrashed()->join("at_rol_usuario","at_usuarios.n_id","=","at_rol_usuario.n_id")
//       ->join("at_roles","at_roles.n_id_rol","=","at_rol_usuario.n_id_rol")
//       ->get();
        $usuarios = User::with('rol')
            ->withTrashed()
            ->orderBy('v_nombres')
            ->get();
       return response()->json($usuarios);
    }

    public function menu_usuario()
    {
        $id = auth()->user()->n_id;
        $menu = Menu::select('am2.n_id_menu', 'am2.v_nombre as label', 'am2.v_rastro as link', 'at_menus.n_id_menu as id_padre', 'at_menus.v_nombre as items', 'am2.n_orden', 'am2.v_icono')
        ->join('at_menus as am2', 'am2.n_padre', '=', 'at_menus.n_id_menu')
        ->join('at_permisos_rol as apr', 'apr.n_id_menu', '=', 'am2.n_id_menu')
        ->join('at_roles as ar', 'apr.n_id_rol', '=', 'ar.n_id_rol')
        ->join('at_rol_usuario as aru', 'aru.n_id_rol', '=', 'ar.n_id_rol')
        ->join('at_usuarios as au', 'au.n_id', '=', 'aru.n_id')
        ->where('am2.b_activado', '=', 'True')
        ->where('au.n_id', '=', $id)
        ->get();
       
        $collection = collect($menu);
        $grouped = $collection->groupBy('items');
        $formatted_response = [];
        foreach ($grouped as $category => $subjects) {
            $formatted_response[] = [
                'item_padre' => $category,
                'items' => $subjects
            ];
        }
        return $formatted_response;
    }
    public function buscar_usuario($id)
    {
        try {
            $usuario=User::get_usuario_detalles($id); 
            return response()->json($usuario);
        } catch (Exception $e) {
            return response()->json($e);
        }        
    }

    public function actualizar_usuario($id, Request $request)
    {
        try
        {
            $usuario=User::actualizar_usuario($id, $request);
            $response['status'] = 1;
            $response['message'] = 'Usuario Actualizado Exitosamente! ';
            $response['code'] = 200;
            $response['data'] = $usuario;
            return response()->json($response);
        }
        catch (Exception $e) {
            return response()->json($e);
        } 
        //return $id;
    }

    public function actualizar_pass($id, Request $request)
    {
        try
        {
            $usuario=User::actualizar_password($id, $request);
            $response['status'] = 1;
            $response['message'] = 'Contraseña Actualizada Exitosamente! ';
            $response['code'] = 200;
            $response['data'] = $usuario;
            return response()->json($response);
        }
        catch (Exception $e) {
            return response()->json($e);
        } 
    }
    public function destroy($id)
    {
        $Us = User::findOrFail($id);
        $Us->delete();
        return $this->showMessage("Usuario eliminado");
    }
    public function recuperarUsuario($id)
    {
        User::withTrashed()->find($id)->restore();
//        $Us = User::find($id);
        return $this->showMessage("Datos del usuario recuperado");

    }


}
