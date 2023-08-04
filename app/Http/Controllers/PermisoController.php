<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Role;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermisoController extends Controller
{

    public function registrar_permisos(Request $request)
    {
       // $accesos = json_encode($request->ides);
        $rol = Role::find($request->idrol);
        $rol->menus()->attach($request->ides);    
     
        $response['status'] = 1;
        $response['message'] = 'Permisos Registrados Exitosamente! ';
        $response['code'] = 200;      
        
        return response()->json($response);
    }

    public function obtener_permisosrol($id)
    {
        $permisos= Permiso::get_permisos_rol($id);
        return response()->json($permisos);
    }
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
    public function create()
    {
        //
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
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function show(Permiso $permiso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function edit(Permiso $permiso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permiso $permiso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permiso $permiso)
    {
        //
    }
}
