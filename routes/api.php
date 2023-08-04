<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaGerenciaController;
use App\Http\Controllers\PaDepartamentoController;
use App\Http\Controllers\PaCentroCostoController;
use App\Http\Controllers\PaUnidadMedidaController;
use App\Http\Controllers\TsFormularioController;
use App\Http\Controllers\TsOrdenInternaController;
use App\Http\Controllers\TsSolpedObsController;
use App\Http\Controllers\TsSolpedController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', [AuthController::class, 'login']);
Route::post('olvido_pass', [PasswordController::class, 'olvido_pass']);
Route::post('reset_password', [PasswordController::class, 'reset_password']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('user', [AuthController::class, 'user']);
    Route::post('registro', [AuthController::class, 'registro']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('listar_usuarios', [AuthController::class, 'listar_usuarios']);
    Route::get('menu_usuario', [AuthController::class, 'menu_usuario']);
    Route::resource('usuario', AuthController::class) -> only(['destroy']);
    Route::get('usuario-recuperado/{id}', [AuthController::class,'recuperarUsuario']);
    Route::post('admin/registrar_rol', [RoleController::class, 'registrar_rol']);
    Route::get('admin/listar_roles', [RoleController::class, 'listar_roles']);
    Route::resource('rol', RoleController::class) -> only(['destroy']);
    Route::get('admin/listar_accesos', [RoleController::class, 'listar_accesos']);
    Route::resource('acceso', MenuController::class) -> only(['destroy']);
    Route::get('admin/listar_accesospadres', [RoleController::class, 'listar_accesospadres']);
    Route::get('admin/listar_accesosrol', [RoleController::class, 'listar_accesosrol']);
    Route::get('admin/buscar_acceso/{id_acceso}', [RoleController::class, 'buscar_acceso']);
    Route::post('admin/actualizar_acceso/{id_acceso}', [RoleController::class, 'actualizar_acceso']);
    Route::get('admin/buscar_rol/{id_rol}',[RoleController::class, 'BuscarRol']);
    Route::post('admin/actualizar_rol/{id_rol}',[RoleController::class, 'actualizarRol']);
    Route::get('admin/buscar_usuario/{id_usuario}',[AuthController::class, 'buscar_usuario']);
    Route::post('admin/actualizar_usuario/{id_usuario}',[AuthController::class, 'actualizar_usuario']);
    Route::post('admin/actualizar_pass/{id_usuario}',[AuthController::class, 'actualizar_pass']);
    Route::post('admin/registrar_menu', [RoleController::class, 'registrar_menu']);
    Route::post('admin/registrar_permisos', [PermisoController::class, 'registrar_permisos']);
    Route::get('admin/obtener_permisosrol/{id_rol}', [PermisoController::class, 'obtener_permisosrol']);
    Route::post('Imagen/guardar_imagen', [ImageController::class, 'guardar_imagen']);

    //rutas de paramétricas
    Route::resource('unidad-medida',PaUnidadMedidaController::class);
    Route::resource('gerencia', PaGerenciaController::class);
    Route::resource('departamento', PaDepartamentoController::class);
    Route::resource('centro-costo', PaCentroCostoController::class);

    //selects
    Route::get('departamento-gerencia/{id}', [PaGerenciaController::class,'obtenerDepartamentoGerencia']);
    Route::get('departamento-centro-costo/{id}', [PaGerenciaController::class,'obtenerDepartamentoCentroCosto']);
    //solped
    Route::resource('solped',TsSolpedController::class);   
    // solped formulario
    Route::resource('formulario-solped',TsFormularioController::class);    
    Route::put('formulario-solped-verificar/{id}', [TsFormularioController::class,'updateChecked']);
    Route::get('formulario-solped-eliminar/{id}', [TsFormularioController::class,'printFinished']);
    Route::put('formulario-solped-rechazar/{id}', [TsFormularioController::class,'reject']);
    Route::get('ordenes/{id_departamento}', [TsFormularioController::class,'getDataOrdenPosicionDepartamento']);
    //orden    
    Route::resource('orden',TsOrdenInternaController::class);   
    //obs de solpes
    Route::resource('obs',TsSolpedObsController::class); 

});
