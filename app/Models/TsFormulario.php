<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 15/3/2023
 * Time: 10:30
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TsFormulario extends Model
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    protected $table = 'ts_formulario';
    const CREATED_AT = 'd_fecha_creacion';
    const UPDATED_AT = 'd_fecha_modificacion';
    protected $dates = ['d_fecha_eliminacion'];
    const DELETED_AT = 'd_fecha_eliminacion';
    protected $primaryKey = 'n_id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'n_id_usuario',
        'n_id_departamento',
        'n_solped_sap',
        'n_correlativo_solicitud',
        'v_descripcion',
        'd_fecha_inicio_obra',
        'n_plazo_ejecucion',
        'n_af',
        'v_observaciones',
        'v_tipo',
        'n_total',
        'n_tipo_cambio',
        'n_monto_solped',
        'n_impuesto',
        'n_monto_pagar',
        'c_estado',
        'n_necesidad',
        'd_fecha_creacion_solped',
        'd_fecha_modificacion_solped',
        'n_control_presupuestario',
        'd_fecha_certificacion',
        'v_obs'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'd_fecha_eliminacion',
    ];
}
