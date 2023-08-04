<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
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
    public function guardar_imagen(Request $request)
    {
        $imagen = new Image;
        if ($request->hasFile('imagen'))
        {
            $nombreArchivoOriginal = $request->file('imagen')->getClientOriginalName();
            $soloNombreArchivo = pathinfo($nombreArchivoOriginal,PATHINFO_FILENAME );
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $nombreCompleto = str_replace(' ', '_', $soloNombreArchivo).'-'.rand().'_'.time().'.'.$extension;
            $path = $request->file('imagen')->storeAs('public/vehiculos/'.$request->id_vehiculo, $nombreCompleto);
            $imagen->v_nombre = $nombreCompleto;
            $imagen->n_id_vehiculo = $request->id_vehiculo;
            $imagen->v_ruta = $path;
            $imagen->v_observaciones = 'obs';
        }
        if($imagen->save())
        {
            return ['status' => true, 'message' => 'Carga correcta'];
        }
        else
        {
            return ['status' => false, 'message' => 'Carga INcorrecta'];
        }
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
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
