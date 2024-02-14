<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar rutas API para tu aplicación. Estas
| rutas se cargan por el RouteServiceProvider dentro de un grupo que
| se asigna al grupo de middleware "api". ¡Disfruta construyendo tu API!
|
*/

// Rutas existentes que podrías tener
// ...

// Añade aquí tu ruta DELETE para eliminar actores por ID
Route::delete('/actors/{id}', [ActorController::class, 'deleteActor']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    
});
