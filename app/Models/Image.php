<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'at_vehiculo_imagenes';
    protected $primaryKey = 'n_id_imagen';
    public $timestamps = false;

    protected $guarded = [];
}
