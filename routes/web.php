<?php

use App\Models\User;
use App\Models\Voluntarios;
use Illuminate\Support\Facades\Route;
// use RobRichards\XMLSecLibs\XMLSecurityDSig;
// use RobRichards\XMLSecLibs\XMLSecurityKey;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// dd(Route::getRoutes());
// XMLSecurityDSig
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('per','Api\Voluntarios\VoluntariosApiController@obtenerDepartamentos')->name('per');

