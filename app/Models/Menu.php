<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Menu extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes, Notifiable,SoftDeletes;
    protected $table = 'at_menus';
    protected $primaryKey = 'n_id_menu';
    public $timestamps = false;
    const CREATED_AT = 'd_creacion';
    const UPDATED_AT = 'd_actualizacion';
    protected $dates = ['d_eliminacion'];
    const DELETED_AT = 'd_eliminacion';

    protected $guarded = [];

public function roles() {
    return $this->belongsToMany('App\Models\Role', 'at_permisos_rol', 'n_id_menu', 'n_id_rol');
}

public static function actualizarAcceso($id, $data)
{
    $acceso = Menu::findOrFail($id);
    $acceso->v_nombre = $data->v_nombre;
    $acceso->v_rastro = $data->v_rastro;
    $acceso->n_padre = $data->n_padre;
    $acceso->b_activado = $data->b_activado;
    $acceso->v_icono = $data->v_icono;
    $acceso->d_actualizacion = now();
    $acceso->save();
    return $acceso;
}

protected function serializeDate(DateTimeInterface $date)
{
    return $date->format('d-m-Y H:i:s');
}


}
