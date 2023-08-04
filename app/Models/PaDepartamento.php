<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 21/11/2022
 * Time: 15:40
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class PaDepartamento extends Model
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    protected $table = 'pa_departamento';
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
        'n_id_gerencia',
        'v_descripcion'
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
