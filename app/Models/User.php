<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes, Notifiable;

    protected $table = 'at_usuarios';
    public $timestamps = false;
    protected $primaryKey = 'n_id';
    const CREATED_AT = 'd_creacion';
    const UPDATED_AT = 'd_actualizacion';
    protected $dates = ['d_eliminacion'];
    const DELETED_AT = 'd_eliminacion';

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];
    protected $fillable = ['v_nombres_apellidos',
        'v_usuario',
        'v_nombres',
        'v_apellido_paterno',
        'v_apellido_materno',
//        'v_cargo',
        'v_ci',
        'v_email',
        'n_id_rol',
        'v_password',
        'n_id_departamento'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->v_password;
    }

    public function rolusuario()
    {
        return $this->hasOne('App\Models\RoleUsuario', 'n_id');
        // note: we can also inlcude Mobile model like: 'App\Mobile'
    }

    public function rol() {
        return $this->hasMany(RoleUsuario::class, 'n_id', 'n_id')
            ->join('at_roles', 'at_roles.n_id_rol', '=', 'at_rol_usuario.n_id_rol');
    }

    public function vehiculos() {
        return $this->belongsToMany('App\Models\Vehiculo', 'at_asignaciones', 'n_id','n_id_vehiculo');
    }

    public static function get_usuario_detalles($id)
    {
        try {
            return User::join('at_rol_usuario as aru', 'at_usuarios.n_id', '=', 'aru.n_id')
            ->join('at_roles as ar', 'aru.n_id_rol', '=', 'ar.n_id_rol')
            ->where('at_usuarios.n_id',$id)->firstOrFail();
        } catch (\Illuminate\Database\QueryException $er) {
            return $er;
        }
    }

    public static function actualizar_usuario($id, $data)
    {
       // $user = User::find($id);
        $user = User::with('rolusuario')->find($id);
        $user->v_nombres = $data->v_nombres;
        $user->v_apellido_paterno = $data->v_apellido_paterno;
        $user->v_apellido_materno = $data->v_apellido_materno;
//        $user->v_cargo = $data->v_cargo;
        $user->v_ci = $data->v_ci;
        $user->v_email = $data->v_email;   
        $user->rolusuario->n_id_rol = $data->n_id_rol;   
        $user->d_actualizacion = now(); 
        $user->rolusuario->d_actualizacion = now();
        $user->n_id_departamento = $data->id_departamento;
        $user->push();
        return $user;
    }


    public static function actualizar_password($id, $data)
    {
        $user = User::find($id);
        $user->v_password = Hash::make($data->password);
        $user->save();
        return $user;
    }

}
