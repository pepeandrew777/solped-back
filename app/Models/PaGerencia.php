<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 21/11/2022
 * Time: 15:19
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PaGerencia extends Model
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    protected $table = 'pa_gerencia';
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
        'n_id',
        'v_descripcion',
        'd_fecha_creacion',
        'd_fecha_modificacion'
    ];
    protected $hidden = [
        'd_fecha_eliminacion',
    ];

}
