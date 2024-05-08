<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\UserSpecializationController;
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

//Manejo del error en el sistema
//Error si no hay un dato
Route::get('/404', function () {
    return view('page.404');
});
//Uusario no tiene acceso
Route::get('/401', function () {
    return view('page.401');
});
//Usuario no tiene acceso
Route::get('/500', function () {
    return view('page.500');
});

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
    Route::get('admin/admin/edit/{slug}',[AdminController::class,'edit']);
    //Envio de datos para el edit
    Route::post('admin/admin/edit/{slug}',[AdminController::class,'update']);
    //Envio de las foto de perfil
    Route::post('admin/admin/edit/photo/{slug}',[AdminController::class,'photo']);
    //delete get
    Route::get('admin/admin/delete/{id}',[AdminController::class,'delete']);
    //Generar Reporte de Usuarios
    Route::get('admin/admin/reporte',[AdminController::class,'reporte']);

    //Rutas pra crear los grupos
    //La vista de los usuarios
    Route::get('/admin/rol/list',[UserGroupController::class,'list']);
    //La vista crear usuario
    Route::get('/admin/rol/add',[UserGroupController::class,'add']);
    //Envio de datos para registrar
    Route::post('/admin/rol/add',[UserGroupController::class,'insert']);
    //Vista editar
    Route::get('admin/rol/edit/{usergroup}',[UserGroupController::class,'edit']);
    //Envio de datos para el edit
    Route::post('admin/rol/edit/{usergroup}',[UserGroupController::class,'update']);
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
    
    //Rutas para las citas
    Route::get('/admin/cita/list',[CitaController::class,'list']);

    //Rutas para asignar los doctores a un 
    //La vista de la asignación a doctor
    Route::get('/admin/assignment',[UserSpecializationController::class,'list']);
    //Envio de datos para registrar
    Route::post('/admin/assignment',[UserSpecializationController::class,'insert']);
    //delete get
    Route::get('admin/assignment/delete/{id}',[UserSpecializationController::class,'delete']);
});
Route::group(['middleware'=>'secretary'],function(){
    //La vista del dashbaord
    Route::get('secretary/dashboard',[DashboardController::class,'dashboard']); 
    //Rutas para las citas
    Route::get('secretary/cita/list',[CitaController::class,'list']);
    //Ruta para ver el perfil
    Route::get('secretary/perfil',[ProfileController::class,'index']);
    //Enviar los datos del usuario en su perfil
    Route::post('secretary/perfil/edit/{user}',[ProfileController::class,'update']);    
    //Envio de las foto de perfil
    Route::post('secretary/perfil/photo/{user}',[ProfileController::class,'photo']);
});
Route::group(['middleware'=>'doctor'],function(){
    //La vista del dashbaord
    Route::get('doctor/dashboard',[DashboardController::class,'dashboard']);
    //Ruta para ver el perfil
    Route::get('doctor/perfil',[ProfileController::class,'index']);
    //Enviar los datos del usuario en su perfil
    Route::post('doctor/perfil/edit/{user}',[ProfileController::class,'update']);      
    //Envio de las foto de perfil
    Route::post('doctor/perfil/photo/{user}',[ProfileController::class,'photo']); 
    //Doctor vea sus especialidades y progreso
    Route::get('doctor/specialization/list',[DoctorController::class,'list']);
});
