<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class TsSolpedObs extends Model
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    protected $table = 'ts_solped_obs';
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
        'v_campo',
        'v_obs',
        'n_id_formulario',
        'n_id_usuario',
        'n_id_solped'];
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
    public function formulario(){
        return $this->belongsTo(TsFormulario::class,'n_id_formulario');
    }
    public function solped(){
        return $this->belongsTo(TsSolped::class,'n_id_solped');
    }

}
