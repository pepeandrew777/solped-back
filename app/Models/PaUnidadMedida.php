<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 23/2/2023
 * Time: 16:13
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class PaUnidadMedida extends Model
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    protected $table = 'pa_unidad_medida';
    protected $primaryKey = 'n_id';
 //   public $timestamps = false;
    const CREATED_AT = 'd_fecha_creacion';
    const UPDATED_AT = 'd_fecha_actualizacion';
    const DELETED_AT = 'd_fecha_eliminacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'n_id',
        'v_codigo',
        'v_descripcion',
        'd_fecha_creacion',
        'd_fecha_actualizacion',
        'd_fecha_eliminacion'
    ];
    protected $hidden = [
        'd_fecha_eliminacion',
    ];

}
