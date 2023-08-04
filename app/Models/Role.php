<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Role extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes, Notifiable;
    protected $table = 'at_roles';
    protected $primaryKey = 'n_id_rol';
    public $timestamps = false;
    const CREATED_AT = 'd_creacion';
    const UPDATED_AT = 'd_actualizacion';
    protected $dates = ['d_eliminacion'];
    const DELETED_AT = 'd_eliminacion';

    protected $guarded = [];


    public function menus() {
        return $this->belongsToMany('App\Models\Menu', 'at_permisos_rol', 'n_id_rol', 'n_id_menu');
    }

    public static function actualizar_rol($id, $data)
    {
        $rol = Role::findOrFail($id);
        $rol->v_nombre_rol = $data->v_nombre_rol;
        $rol->v_nombre_mostrar_rol = $data->v_nombre_mostrar_rol;
        $rol->v_descripcion_rol = $data->v_descripcion_rol;
        $rol->d_actualizacion = now();
        $rol->save();
        return $rol;
    }

    /*
      public function menus() {
        return $this->belongsToMany('App\Models\Menu', 'at_permisos_rol', 'n_id_rol', 'n_id_rol');
    }
    * Prepare a date for array / JSON serialization.
    *
    * @param  \DateTimeInterface  $date
    * @return string
    */
/*
    public function menus()
    {
        return $this->hasManyThrough(
            // required
            'App\Models\Menu', // the related model
            'App\Models\Permiso', // the pivot model

            // optional
            'n_id_rol', // the current model id in the pivot
            'n_id_menu', // the id of related model
            'n_id_rol', // the id of current model
            'n_id_rol' // the related model id in the pivot
        );
    }
    */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }
    
}
