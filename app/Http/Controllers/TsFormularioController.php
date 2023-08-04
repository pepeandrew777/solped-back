<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 15/3/2023
 * Time: 10:41
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TsFormulario;
use App\Models\TsSolped;
use App\Models\TsSolpedObs;
use App\Models\PaDepartamento;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;



class TsFormularioController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TsFormulario::get();
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
            'n_id_usuario' => 'required',
            'n_id_departamento' => 'required',
            'n_correlativo_solicitud' => 'required',
            'v_tipo' => 'required',
            'n_total' => 'required',
            'n_monto_pagar' => 'required',
            'solpeds' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->showMessage($validator->messages(), 400);
        }

        $formulario = new TsFormulario();
        $formulario->n_id_usuario = $request->n_id_usuario;
        $formulario->n_id_departamento = $request->n_id_departamento;
        $formulario->n_solped_sap = $request->n_solped_sap;
        $formulario->n_correlativo_solicitud = $request->n_correlativo_solicitud;
        $formulario->v_descripcion = $request->v_descripcion;
        $formulario->d_fecha_inicio_obra = $request->d_fecha_inicio_obra;
        $formulario->n_plazo_ejecucion = $request->n_plazo_ejecucion;
        $formulario->n_af = $request->n_af;
        $formulario->v_observaciones = $request->v_observaciones;
        $formulario->v_tipo = $request->v_tipo;
        $formulario->n_total = $request->n_total;
        $formulario->n_tipo_cambio = $request->n_tipo_cambio;
        $formulario->n_monto_solped = $request->n_monto_solped;
        $formulario->n_impuesto = $request->n_impuesto;
        $formulario->n_monto_pagar = $request->n_monto_pagar;
        $formulario->c_estado = 'P';
        $formulario->save();

        // Registro de solped
        $id_formulario = $formulario->n_id;
        $array_solped = $request->solpeds;
        foreach ($array_solped as $solp) {
            $solped = new TsSolped();
            $solped->n_id_formulario = $id_formulario;
            $solped->n_fondo = $solp['n_fondo'];
            $solped->n_id_ceco = $solp['n_id_ceco'];
            $solped->n_centro_costo = $solp['n_centro_costo'];
            $solped->v_orden = $solp['v_orden'];
            $solped->v_posicion_pres = $solp['v_posicion_pres'];
            $solped->v_cod_mat_almacen = $solp['v_cod_mat_almacen'];
            $solped->v_descripcion = $solp['v_descripcion'];
            $solped->n_cantidad = $solp['n_cantidad'];
            $solped->v_unidad = $solp['v_unidad'];
            $solped->n_precio_unitario = $solp['n_precio_unitario'];
            $solped->n_moneda = $solp['n_moneda'];
            $solped->n_precio_total = $solp['n_precio_total'];
            $solped->save();
        }
        $detalle = TsSolped::where('n_id_formulario','=', $id_formulario)
                           ->get();
        $formulario->detalle = $detalle;
        return $this->validResponse($formulario,Response::HTTP_OK,"Se guardó el registro correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $data = TsFormulario::findOrFail($id);


        $detalleSolped = TsSolped::where('n_id_formulario','=', $id)
                                 ->get();
        $observaciones = TsSolpedObs::where('n_id_formulario','=', $id)
                                    ->orderBy('n_id','asc')
                                    ->get();
        $data['detalle'] = $detalleSolped;
        $data['observaciones'] = $observaciones;
        return response()->json(['data' => $data], 200);
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
            'n_id_usuario' => 'required',
            'n_id_departamento' => 'required',
            'n_correlativo_solicitud' => 'required',
            'v_tipo' => 'required',
            'n_total' => 'required',
            'n_monto_pagar' => 'required',
            'solpeds' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->showMessage($validator->messages(), 400);
        }
        $formulario = TsFormulario::findOrFail($id);
        $formulario->n_id_usuario = $request->n_id_usuario;
        $formulario->n_id_departamento = $request->n_id_departamento;
        $formulario->n_solped_sap = $request->n_solped_sap;
        $formulario->n_correlativo_solicitud = $request->n_correlativo_solicitud;
        $formulario->v_descripcion = $request->v_descripcion;
        $formulario->d_fecha_inicio_obra = $request->d_fecha_inicio_obra;
        $formulario->n_plazo_ejecucion = $request->n_plazo_ejecucion;
        $formulario->n_af = $request->n_af;
        $formulario->v_observaciones = $request->v_observaciones;
        $formulario->v_tipo = $request->v_tipo;
        $formulario->n_total = $request->n_total;
        $formulario->n_tipo_cambio = $request->n_tipo_cambio;
        $formulario->n_monto_solped = $request->n_monto_solped;
        $formulario->n_impuesto = $request->n_impuesto;
        $formulario->n_monto_pagar = $request->n_monto_pagar;
        $formulario->c_estado = $request->c_estado;;
        $formulario->save();
        $array_solped = $request->solpeds;
        foreach ($array_solped as $solp) {
            if(isset($solp['n_id'])){
                $solped = TsSolped::findOrFail($solp['n_id']);
                $solped->n_id_formulario = $id;
                $solped->n_fondo = $solp['n_fondo'];
                $solped->n_id_ceco = $solp['n_id_ceco'];
                $solped->n_centro_costo = $solp['n_centro_costo'];
                $solped->v_orden = $solp['v_orden'];
                $solped->v_posicion_pres = $solp['v_posicion_pres'];
                $solped->v_cod_mat_almacen = $solp['v_cod_mat_almacen'];
                $solped->v_descripcion = $solp['v_descripcion'];
                $solped->n_cantidad = $solp['n_cantidad'];
                $solped->v_unidad = $solp['v_unidad'];
                $solped->n_precio_unitario = $solp['n_precio_unitario'];
                $solped->n_moneda = $solp['n_moneda'];
                $solped->n_precio_total = $solp['n_precio_total'];
                $solped->save();
            } else {
                $solped = new TsSolped();
                $solped->n_id_formulario = $id;
                $solped->n_fondo = $solp['n_fondo'];
                $solped->n_id_ceco = $solp['n_id_ceco'];
                $solped->n_centro_costo = $solp['n_centro_costo'];
                $solped->v_orden = $solp['v_orden'];
                $solped->v_posicion_pres = $solp['v_posicion_pres'];
                $solped->v_cod_mat_almacen = $solp['v_cod_mat_almacen'];
                $solped->v_descripcion = $solp['v_descripcion'];
                $solped->n_cantidad = $solp['n_cantidad'];
                $solped->v_unidad = $solp['v_unidad'];
                $solped->n_precio_unitario = $solp['n_precio_unitario'];
                $solped->n_moneda = $solp['n_moneda'];
                $solped->n_precio_total = $solp['n_precio_total'];
                $solped->save();
            }

        }
        $detalle = TsSolped::where('n_id_formulario','=', $id)
                           ->get();
        $formulario['detalle'] = $detalle;
        return $this->validResponse($formulario,Response::HTTP_OK,"Se actualizó el registro correctamente");
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
    public function updateChecked(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'n_solped_sap' => 'required',
            'n_necesidad' => 'required',
            'n_control_presupuestario' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->showMessage($validator->messages(), 400);
        }
        $formulario = TsFormulario::findOrFail($id);
        //return $formulario;
        $formulario->n_solped_sap = $request->n_solped_sap;
        $formulario->n_necesidad = $request->n_necesidad;
        $formulario->d_fecha_creacion_solped = date("Y-m-d H:i:s");
        $formulario->n_control_presupuestario = $request->n_control_presupuestario;
        $formulario->c_estado = 'V';
      //  dd($formulario);
        $formulario->save();

        return $this->validResponse($formulario,Response::HTTP_OK,"Se verificó el registro correctamente");
    }
    public function printFinished($id){
        $formulario = TsFormulario::findOrFail($id);
        $formulario->c_estado = 'F';
        $formulario->save();
        return $this->validResponse($formulario,Response::HTTP_OK,"Se finalizó el registro correctamente");
    }
    public function reject(Request $request,$id){

        $formulario = TsFormulario::findOrFail($id);
        if($request->obs){
        $formulario->v_obs = $request->obs;
        }


        $formulario->c_estado = 'R';
        $formulario->save();
        return $this->validResponse($formulario,Response::HTTP_OK,"Se rechazó el registro correctamente");
    }
    public function getDataOrdenPosicionDepartamento($id_departamento) {

        $data = PaDepartamento::join('pa_centro_costo','pa_departamento.n_id','=','pa_centro_costo.n_id_departamento')
                              ->join('ts_orden_interna','pa_departamento.n_id','=','ts_orden_interna.n_id_departamento')
                              ->where('pa_departamento.n_id',$id_departamento)
                              ->get(['pa_centro_costo.n_ceco',
                              'pa_departamento.v_descripcion',
                              'ts_orden_interna.v_orden_interna',
                              'ts_orden_interna.v_descripcion',
                              'ts_orden_interna.n_pos_pres',
                              'ts_orden_interna.v_descripcion_pos'
                                     ]);

        return $this->showAll($data);
    }

}
