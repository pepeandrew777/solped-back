<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 21/11/2022
 * Time: 15:43
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PaDepartamento;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;


class PaDepartamentoController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PaDepartamento::get();
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
        $validator = Validator::make($request->all(),[
            'n_id_gerencia' => 'required',
            'v_descripcion' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->showMessage($validator->messages(), 400);
        }

        $depto = new PaDepartamento();
        $depto->n_id_gerencia = $request->n_id_gerencia;
        $depto->v_descripcion = $request->v_descripcion;
        $depto->save();
        return $this->showMessage("Se guardó el registro correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PaDepartamento::where('n_id', $id)
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'n_id_gerencia' => 'required',
            'v_descripcion' => 'required'
        ]);
        if ($validator->fails())
        {
            return $this->showMessage($validator->messages(), 400);
        }
        $depto = PaDepartamento::findOrFail($id);
        $depto->n_id_gerencia = $request->n_id_gerencia;
        $depto->v_descripcion = $request->v_descripcion;
        $depto->save();
        return $this->showMessage("Se actualizó el registro correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PaDepartamento::findOrFail($id)
        ->delete();
        return $this->showMessage("Se eliminó el departamento");
    }
}