<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'voluntarios'], function(){
    Route::get('existe','Voluntarios\VoluntariosApiController@existPasaporte')->name('admin.voluntarios.existe-pasaporte');
    Route::get('ciudades','Voluntarios\VoluntariosApiController@obtenerCiudades')->name('admin.voluntarios.ciudades');
    Route::get('facultad','Voluntarios\VoluntariosApiController@obtenerFacultades')->name('admin.voluntarios.facultad');
    Route::get('tutores','Voluntarios\VoluntariosApiController@obtenerTutores')->name('admin.voluntarios.tutores');
});