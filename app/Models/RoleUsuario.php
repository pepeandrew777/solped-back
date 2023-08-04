<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUsuario extends Model
{
    use HasFactory;
    protected $table = 'at_rol_usuario';
    public $timestamps = false;
    protected $primaryKey = 'n_id_rolusuario';

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\User', 'n_id');
    }
}
