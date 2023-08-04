<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 15/3/2023
 * Time: 10:35
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class TsSolped extends Model
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    protected $table = 'ts_solped';
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
        'n_id_formulario',
        'n_fondo',
        'n_centro_costo',
        'v_orden',
        'v_posicion_pres',
        'v_cod_mat_almacen',
        'v_descripcion',
        'n_cantidad',
        'v_unidad',
        'n_precio_unitario',
        'n_moneda',
        'n_precio_total',
        'n_id_ceco',
        'n_id_n_fondo_obs',
        'n_id_n_centro_costo_obs',
        'n_id_v_orden_obs',
        'n_id_v_posicion_pres_obs',
        'n_id_v_cod_mat_almacen_obs',
        'n_id_v_descripcion_obs',
        'n_id_n_cantidad_obs',
        'n_id_v_unidad_obs',
        'n_id_n_precio_unitario_obs',
        'n_id_n_moneda_obs',
        'n_id_n_precio_total_obs',
        'n_id_n_id_ceco_obs'
       ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'd_fecha_eliminacion',
    ];
    public function registrarIdObs($campo,$id_solpe_obs) {
        switch ($campo) {
            case 'n_fondo':
                 $this->n_id_n_fondo_obs            = $id_solpe_obs;
                 $this->save();
                 break;
            case 'n_centro_costo':
                 $this->n_id_n_centro_costo_obs     = $id_solpe_obs;
                 $this->save();
                 break;
            case 'v_orden':
                 $this->n_id_v_orden_obs             = $id_solpe_obs;
                 $this->save();
                 break;
            case 'v_posicion_pres':
                 $this->n_id_v_posicion_pres_obs     = $id_solpe_obs;
                 $this->save();
                 break;
            case 'v_cod_mat_almacen':
                 $this->n_id_v_cod_mat_almacen_obs   = $id_solpe_obs;
                 $this->save();
                 break;
            case 'v_descripcion':
                 $this->n_id_v_descripcion_obs       = $id_solpe_obs;
                 $this->save();
                 break;
            case 'n_cantidad':
                 $this->n_id_n_cantidad_obs          = $id_solpe_obs;
                 $this->save();
                 break;
            case 'v_unidad':
                 $this->n_id_v_unidad_obs            =  $id_solpe_obs;
                 $this->save();
                 break;
            case 'n_precio_unitario':
                 $this->n_id_n_precio_unitario_obs   =   $id_solpe_obs;
                 $this->save();
                 break;
            case 'n_moneda':
                 $this->n_id_n_moneda_obs            =   $id_solpe_obs;
                 $this->save();
                 break;
            case 'n_precio_total':
                 $this->n_id_n_precio_total_obs      =   $id_solpe_obs;
                 $this->save();
                 break;
            case 'n_id_ceco':
                 $this->n_id_n_id_ceco_obs           =   $id_solpe_obs;
                 $this->save();
                 break;
            default:
                 break;
        }

    }
    public function formulario(){
     return $this->belongsTo(TsFormulario::class,'n_id_formulario');
    }
    public function centro_costo(){
     return $this->belongsTo(PaCentroCosto::class,'n_id_ceco');
    }



}
