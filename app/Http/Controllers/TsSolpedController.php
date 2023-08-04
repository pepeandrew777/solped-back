<?php

namespace App\Http\Controllers;

use App\Models\TsSolped;
use App\Models\TsSolpedObs;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
class TsSolpedController extends Controller
{
    use ApiResponser;
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
     * @param  \App\Models\TsSolped  $tsSolped
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $IdsObservaciones = [];
        $data = TsSolped::with('formulario','centro_costo')->findOrFail($id);
        if($data->n_id_n_fondo_obs){
           array_push($IdsObservaciones,$data->n_id_n_fondo_obs);
        }
        if($data->n_id_n_centro_costo_obs){
            array_push($IdsObservaciones,$data->n_id_n_centro_costo_obs);
        }
        if($data->n_id_v_orden_obs){
            array_push($IdsObservaciones,$data->n_id_v_orden_obs);
        }
        if($data->n_id_v_posicion_pres_obs){
            array_push($IdsObservaciones,$data->n_id_v_posicion_pres_obs);
        }
        if($data->n_id_v_cod_mat_almacen_obs){
            array_push($IdsObservaciones,$data->n_id_v_cod_mat_almacen_obs);
        }
        if($data->n_id_v_descripcion_obs){
            array_push($IdsObservaciones,$data->n_id_v_descripcion_obs);
        }
        if($data->n_id_n_cantidad_obs){
            array_push($IdsObservaciones,$data->n_id_n_cantidad_obs);
        }
        if($data->n_id_v_unidad_obs){
            array_push($IdsObservaciones,$data->n_id_v_unidad_obs);
        }
        if($data->n_id_n_precio_unitario_obs){
            array_push($IdsObservaciones,$data->n_id_n_precio_unitario_obs);
        }
        if($data->n_id_n_moneda_obs){
            array_push($IdsObservaciones,$data->n_id_n_moneda_obs);
        }
        if($data->n_id_n_precio_total_obs){
            array_push($IdsObservaciones,$data->n_id_n_precio_total_obs);
        }
        if($data->n_id_n_id_ceco_obs){
            array_push($IdsObservaciones,$data->n_id_n_id_ceco_obs);
        }
        $observaciones = TsSolpedObs::select('n_id','v_campo','v_obs','n_id_formulario','n_id_usuario','n_id_solped')
                                    ->whereIn('n_id',$IdsObservaciones)
                                    //->WhereIsNotNull('d_fecha_eliminacion')
                                    ->OrderBy('n_id','asc')
                                    ->get();
        $data->observaciones = $observaciones;
        return response()->json(['data' => $data], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TsSolped  $tsSolped
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TsSolped $tsSolped)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TsSolped  $tsSolped
     * @return \Illuminate\Http\Response
     */
    public function destroy(TsSolped $tsSolped)
    {
        //
    }
}
