<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TsOrdenInterna extends Model
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    protected $table = 'ts_orden_interna';
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
        'v_orden_interna',
        'v_descripcion',
        'n_id_gerencia',
        'n_id_departamento',
        'n_pos_pres',
        'v_posicion_pres',
        'v_descripcion_pos',
        'n_id_usuario'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'd_fecha_eliminacion',
    ];

    public function usuario(){
        return $this->belongsTo(User::class,'n_id_usuario');
    }
    public function gerencia(){
        return $this->belongsTo(PaGerencia::class,'n_id_gerencia');
    }
    public function departamento() {
        return $this->belongsTo(PaDepartamento::class,'n_id_departamento');
    }
}
