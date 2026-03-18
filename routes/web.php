<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth']) -> group(function () {
    //Generar rutas de todos los metodos del controlador
    Route::resource('libros', LibroController::class);
});

Route::resource('/libros/{id}/edit', LibroController::class);

Route::get('/libros/{id}/edit', [
    LibroController::class, 'edit'
    ])->name('libros.edit');

    Route::put('/libros/{id}',[
        LibroController::class, 'update'
    ])->name('libros.update');

    //Ruta para el formulario de registro
Route::get('/registro',[
    AuthController::class,'registerForm'
])->name('registro');
 
//Ruta para ejecutar el formulario
Route::post('/registro',[
    AuthController::class,'register'
])->name('registro.store');

Route::get('/acceso',[
    AuthController::class,'loginForm'
])->name('acceso');

//Ruta para manejar los datos de inicio de sesion
Route::post('/acceso',[
    AuthController::class,'login'
])->name('acceso.store');

//ruta para cerrar sesion
Route::post('/cerrar', [
    AuthController::class, 'logout'
])->name('cerrar');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-dashboard', [
        AuthController::class, 'adminDashboard'
    ])->name('admin-dashboard');
});