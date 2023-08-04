<?php

namespace App\Http\Controllers;

use App\Models\TsOrdenInterna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
class TsOrdenInternaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ApiResponser;
    public function index()
    {
        $data = TsOrdenInterna::with('usuario','gerencia','departamento')
                              ->orderBy('n_id','asc')
                              ->get();
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
            'v_orden_interna' => 'required',
            'v_descripcion' => 'required',
            'n_id_gerencia' => 'required',
            'n_id_departamento' => 'required',
            'n_pos_pres' => 'required',
            'v_descripcion_pos' => 'required'           
        ]);
        if ($validator->fails()) {
            return $this->showMessage($validator->messages(), 400);
        }
        $orden = new TsOrdenInterna();
        $orden->v_orden_interna   =  $request->v_orden_interna;
        $orden->v_descripcion     =  $request->v_descripcion;        
        $orden->n_id_gerencia     =  $request->n_id_gerencia;
        $orden->n_id_departamento =  $request->n_id_departamento;
        $orden->n_pos_pres        =  $request->n_pos_pres;
        $orden->v_descripcion_pos =  $request->v_descripcion_pos;
        $orden->n_id_usuario      =  $request->user()->n_id;
        $orden->save();
        return $this->validResponse($orden,Response::HTTP_OK,"Se guardó el registro de orden correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TsOrdenInterna  $tsOrdenInterna
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = TsOrdenInterna::with('usuario','gerencia','departamento')
                              ->findOrFail($id);        
        return response()->json(['data' => $data], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TsOrdenInterna  $tsOrdenInterna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'v_orden_interna' => 'required',
            'v_descripcion' => 'required',
            'n_id_gerencia' => 'required',
            'n_id_departamento' => 'required',
            'n_pos_pres' => 'required',
            'v_descripcion_pos' => 'required'           
        ]);
        if ($validator->fails()) {
            return $this->showMessage($validator->messages(), 400);
        }                
        $orden = TsOrdenInterna::findOrFail($id);
        $orden->v_orden_interna   =  $request->v_orden_interna;
        $orden->v_descripcion     =  $request->v_descripcion;        
        $orden->n_id_gerencia     =  $request->n_id_gerencia;
        $orden->n_id_departamento =  $request->n_id_departamento;
        $orden->n_pos_pres        =  $request->n_pos_pres;
        $orden->v_descripcion_pos =  $request->v_descripcion_pos;
        $orden->n_id_usuario      =  $request->user()->n_id;
        $orden->save();
        return $this->validResponse($orden,Response::HTTP_OK,"Se actualizó el registro de orden correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TsOrdenInterna  $tsOrdenInterna
     * @return \Illuminate\Http\Response
     */
    public function destroy(TsOrdenInterna $tsOrdenInterna)
    {
        //
    }
}
