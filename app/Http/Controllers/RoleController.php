<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Menu;
use App\Models\Permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use function PHPUnit\Framework\isNull;

class RoleController extends ApiController
{
    protected $table = 'at_rol_usuario';
    protected $primaryKey = 'n_id_rolusuario';
    public $timestamps = false;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registrar_rol(Request $request)
    {
        $nombre_rol = Role::where('v_nombre_rol', $request["nombre_rol"])->first();
        if($nombre_rol)
        {
            $response['status'] = 0;
            $response['message'] = 'Rol ya registrado previamente ';
            $response['code'] = 409;
        }
        else
        {
            $rol = Role::create([
                'v_nombre_rol' => $request->input('nombre_rol'),
                'v_nombre_mostrar_rol' => $request->input('nombre_mostrar_rol'),
                'v_descripcion_rol' => $request->input('descripcion_rol')         
            ]);
            //return response($usuario, Response::HTTP_CREATED);
            $response['status'] = 1;
            $response['message'] = 'Rol registrado Exitosamente! ';
            $response['code'] = 200;
        }       

        return response()->json($response);
    }

    public function listar_roles()
    {
        $rol=Role::get();    
        return response()->json($rol);   
     
    }
    public function listar_accesos()
    {
        $resultados = DB::table('at_menus AS am')
        ->select('am2.n_id_menu','am2.v_nombre', 'am2.v_rastro', 'am.v_nombre as padre', 'am2.b_activado', 'am2.n_orden', 'am2.v_icono')
        ->join('at_menus AS am2','am.n_id_menu', 'am2.n_padre')
        ->where('am2.d_eliminacion', NULL)
        ->orderBy('am.n_id_menu')
        ->orderBy('am2.n_orden')
        ->get();
        return response()->json($resultados);
    }

    public function listar_accesospadres()
    {
        $menu = Menu::where("n_padre","=",0)
        ->orderBy('n_id_menu')        
        ->get();
        //$menu = Menu::get();
        return response()->json($menu);   
    }

    public function listar_accesosrol()
    {
        $menu = Menu::where("n_padre","<>",0)->get();
        //$menu = Menu::get();
        return response()->json($menu);   
    }
    
    public function registrar_menu(Request $request)
    {
        $menu = Menu::where('v_nombre', $request['nombre_acceso'])->first();
        if($menu)
        {
            $response['status'] = 0;
            $response['message'] = 'Menu de Acceso " '.$menu->v_nombre.' " ya fue registrado previamente ';
            $response['code'] = 409;
        }
        else
        {
            $menu = Menu::create([
                'v_nombre' => $request->input('nombre_acceso'),
                'v_rastro' => $request->input('ruta_acceso'),
                'n_padre' => $request->input('dependencia'),
                'b_activado' => $request->input('activo'),
                'v_icono' => $request->input('icono'),
                            
            ]);
           
            $response['status'] = 1;
            $response['message'] = 'Menu de Acceso registrado Exitosamente! ';
            $response['code'] = 200;
            $response['data'] = $menu;
        
        }       

        return response()->json($response);
    }

    public function BuscarRol($id_rol)
    {
        $rol = Role::find($id_rol);
        if ($rol)
        {
            return response()->json($rol);
        }
    }

    public function actualizarRol($id, Request $request)
    {
        try
        {
            $rol = Role::actualizar_rol($id, $request);
            $response['status'] = 1;
            $response['message'] = 'Rol Actualizado Exitosamente! ';
            $response['code'] = 200;
            $response['data'] = $rol;
            return response()->json($response);
        }
        catch(Exception $e)
        {
            return response()->json($e);
        }
    }

    public function buscar_acceso($id)
    {
        $acceso = Menu::findOrFail($id);
        return response()->json($acceso);
    }

    public function actualizar_acceso($id, Request $request)
    {
        $acceso = Menu::actualizarAcceso($id, $request);
        $response['status'] = 1;
        $response['message'] = 'Acceso Actualizado Exitosamente! ';
        $response['code'] = 200;
        $response['datos'] = $acceso;
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Rol = Role::findOrFail($id);
        $Rol->delete();
        return $this->showMessage("Rol eliminado");
    }
}
