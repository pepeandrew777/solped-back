<?php

namespace App\Http\Controllers;

use App\Models\TsSolpedObs;
use App\Models\TsSolped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;

class TsSolpedObsController extends Controller
{

    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TsSolpedObs::with('usuario','formulario','solped')->orderBy('n_id','desc')
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
                 'observaciones' => 'array'
         ]);
        if($validator->fails()) {
            return $this->showMessage($validator->messages(), 400);
        }
        if(count($request->observaciones) == 0){
            return $this->showMessage("No se registraron observaciones", 400);
        }
         $i = 1;
         //colocamos valores nullos a todas las solpes y iniciamos de cero
         foreach ($request->observaciones as $obs) {
                TsSolpedObs::where('n_id_formulario',$obs['n_id_formulario'])->delete();
                TsSolped::where('n_id',$obs['n_id_solped'])
                        ->update([
                            'n_id_n_fondo_obs'          => null,
                            'n_id_n_centro_costo_obs'   => null,
                            'n_id_v_orden_obs'          => null,
                            'n_id_v_posicion_pres_obs'  => null,
                            'n_id_v_cod_mat_almacen_obs'=> null,
                            'n_id_v_descripcion_obs'    => null,
                            'n_id_n_cantidad_obs'       => null,
                            'n_id_v_unidad_obs'         => null,
                            'n_id_n_precio_unitario_obs'=> null,
                            'n_id_n_moneda_obs'         => null,
                            'n_id_n_precio_total_obs'   => null,
                            'n_id_n_id_ceco_obs'        => null
                ]);
        }

        //actualizamos las solpes y creamos los nuevos registros de obs
        foreach ($request->observaciones as $obs) {
            if($i == 1)
            {
                TsSolpedObs::where('n_id_formulario',$obs['n_id_formulario'])->delete();
            }
            $solped = TsSolped::findOrFail($obs['n_id_solped']);
            $obsNuevo                  =  new TsSolpedObs();
            $obsNuevo->v_campo         =  $obs['v_campo'];
            $obsNuevo->v_obs           =  $obs['v_obs'];
            $obsNuevo->n_id_formulario =  $obs['n_id_formulario'];
            $obsNuevo->n_id_solped     =  $obs['n_id_solped'];
            $obsNuevo->n_id_usuario    =  $request->user()->n_id;
            $obsNuevo->save();
            $solped->registrarIdObs($obsNuevo->v_campo,$obsNuevo->n_id);
            $i++;
        }
        return $this->showMessage("Se guardaron los registros de observacion correctamente",Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TsSolpedObs  $tsSolpedObs
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = TsSolpedObs::with('usuario','formulario','solped')->findOrFail($id);
        return response()->json(['data' => $data], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TsSolpedObs  $tsSolpedObs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'v_obs' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->showMessage($validator->messages(), 400);
        }
        $obs                  =  TsSolpedObs::findOrFail($id);
        $obs->v_obs           =  $request->v_obs;
        $obs->n_id_usuario    =  $request->user()->n_id;
        $obs->save();
        return $this->validResponse($obs,Response::HTTP_OK,"Se actualizó el registro de la observacion correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TsSolpedObs  $tsSolpedObs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           $obs =  TsSolpedObs::findOrFail($id);
          // Encontramos la solped para anular la observacion de la solped y mandamos valor null a ese id
           $solped =  TsSolped::where('n_id',$obs->n_id_solped)
                              ->firstOrFail();
           $solped->registrarIdObs($obs->v_campo,null);
           //luego eliminamos ese registro de obs de solpe
           $obs->d_eliminacion = date("Y-m-d H:i:s");
           $obs->save();
           return $this->validResponse($obs,Response::HTTP_OK,"Se eliminó el registro de la observacion correctamente");
    }
}
