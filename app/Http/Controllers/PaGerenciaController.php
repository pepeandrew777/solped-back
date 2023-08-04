<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 21/11/2022
 * Time: 15:24
 */

namespace App\Http\Controllers;
use App\Models\PaCentroCosto;
use App\Models\PaDepartamento;
use Illuminate\Http\Request;
use App\Models\PaGerencia;

class PaGerenciaController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PaGerencia::get();
        return $this->showAll($data);
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
    public function show($id)
    {
        $data = PaGerencia::where('n_id', $id)
            ->get();
        return $this->showAll($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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
        //
    }
    public function obtenerDepartamentoGerencia($id){
        $municipios = PaDepartamento::where('n_id_gerencia',$id)
            ->orderBy('n_id')
            ->get();
        return $this->showAll($municipios);
    }
    public function obtenerDepartamentoCentroCosto($id){
        $municipios = PaCentroCosto::where('n_id_departamento',$id)
            ->orderBy('n_id')
            ->get();
        return $this->showAll($municipios);
    }
}