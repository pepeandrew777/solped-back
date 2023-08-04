<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 21/11/2022
 * Time: 16:25
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PaCentroCosto;
use Illuminate\Support\Facades\Validator;


class PaCentroCostoController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PaCentroCosto::get();
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
            'n_id_departamento' => 'required',
            'n_ceco' => 'required',
            'v_descripcion' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->showMessage($validator->messages(), 400);
        }

        $buscado = PaCentroCosto::where('n_ceco', $request->n_ceco)
            ->get();
        if ($buscado->isNotEmpty()) {
            return $this->showMessage("No se puede registrar: El código Centro de Costo ya existe", 400);
        }

        $ceco = new PaCentroCosto();
        $ceco->n_id_departamento = $request->n_id_departamento;
        $ceco->n_ceco = $request->n_ceco;
        $ceco->v_descripcion = $request->v_descripcion;
        $ceco->save();

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
        $data = PaCentroCosto::where('n_id', $id)
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
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'n_id_departamento' => 'required',
            'n_ceco' => 'required',
            'v_descripcion' => 'required'
        ]);
        if ($validator->fails())
        {
            return $this->showMessage($validator->messages(), 400);
        }
        $buscado = PaCentroCosto::where('n_ceco', $request->n_ceco)
            ->get();
        if ($buscado->isNotEmpty()) {
            return $this->showMessage("No se puede actualizar: El código Centro de Costo ya existe", 400);
        }
        $ceco = PaCentroCosto::findOrFail($id);
        $ceco->n_id_departamento = $request->n_id_gerencia;
        $ceco->n_ceco = $request->n_ceco;
        $ceco->v_descripcion = $request->v_descripcion;
        $ceco->save();
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
        PaCentroCosto::findOrFail($id)
            ->delete();
        return $this->showMessage("Se eliminó el Centro de Costot");
    }
}