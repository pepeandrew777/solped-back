<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Permiso extends Model
{
    use HasFactory;
    protected $table = 'at_permisos_rol';
    protected $primaryKey = 'n_id_permiso';
    public $timestamps = false;

    protected $guarded = [];
    //protected $fillable = ['n_id_menu', 'n_id_rol'];

    public static function get_permisos_rol($id)
    {

        $permisorol=Permiso::where('n_id_rol','=',$id)->select('n_id_menu')
        ->get();
        return $permisorol;
    }
   
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }
}
