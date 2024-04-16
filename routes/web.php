<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\UserGroupController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//La vista de log
Route::get('/',[AuthController::class,'login']);
//Evitar los datos del login
Route::post('login',[AuthController::class,'AuthLogin']);
//Cerrar sesion
Route::get('logout',[AuthController::class,'Logout']);

//Manejo del error para el admin
Route::get('/admin/404', function () {
    return view('admin.page.404');
});
//Manejo de error para la secretaria
//Manejo de error para el doctor


//Creamos las rutas de los roles
Route::group(['middleware'=>'admin'],function(){
    //Rutas para el rol de
    //La vista del dashbaord
    Route::get('/admin/dashboard',[DashboardController::class,'dashboard']);
    //La vista de los usuarios
    Route::get('/admin/admin/list',[AdminController::class,'list']);
    //La vista crear usuario
    Route::get('/admin/admin/add',[AdminController::class,'add']);
    //Validación de la API
    Route::post('/admin/admin/add-consulta', [AdminController::class, 'consultarDNI']);
    //Envio de datos para registrar
    Route::post('/admin/admin/add',[AdminController::class,'insert']);
    //Vista editar
    Route::get('admin/admin/edit/{id}',[AdminController::class,'edit']);
    //Envio de datos para el edit
    Route::post('admin/admin/edit/{id}',[AdminController::class,'update']);
    //delete get
    Route::get('admin/admin/delete/{id}',[AdminController::class,'delete']);

    //Rutas pra crear los grupos
    //La vista de los usuarios
    Route::get('/admin/rol/list',[UserGroupController::class,'list']);
    //La vista crear usuario
    Route::get('/admin/rol/add',[UserGroupController::class,'add']);
    //Envio de datos para registrar
    Route::post('/admin/rol/add',[UserGroupController::class,'insert']);
    //Vista editar
    Route::get('admin/rol/edit/{id}',[UserGroupController::class,'edit']);
    //Envio de datos para el edit
    Route::post('admin/rol/edit/{id}',[UserGroupController::class,'update']);
    //delete get
    Route::get('admin/rol/delete/{id}',[UserGroupController::class,'delete']);

    //Rutas para crear las especialidades
    //La vista de los usuarios
    Route::get('/admin/specialization',[SpecializationController::class,'list']);
    //Envio de datos para registrar
    Route::post('/admin/specialization',[SpecializationController::class,'insert']);
    //Envio de datos para el edit
    Route::post('admin/specialization/edit/{id}',[SpecializationController::class,'update']);
    //delete get
    Route::get('admin/specialization/delete/{id}',[SpecializationController::class,'delete']);
});
Route::group(['middleware'=>'secretary'],function(){
    //La vista del dashbaord
    Route::get('secretary/dashboard',[DashboardController::class,'dashboard']); 
});
Route::group(['middleware'=>'doctor'],function(){
    //La vista del dashbaord
    Route::get('doctor/dashboard',[DashboardController::class,'dashboard']); 
});
