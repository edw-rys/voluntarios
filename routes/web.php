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
Route::get('init',function () {
    // Encrypt password
    $users = User::all();
    foreach ($users as $key => $user) {
        //echo($user->Username . ' - '.$user->Password. '<br>');
        $pass =  $user->Password;
        // dd($pass);
        $user->password_ = bcrypt($pass);
        $user->save();
        echo $user->Username . ' '. $pass.'<br>';
        //dd($user);
    }
})->name('usuarios');

Route::get('sss',function () {
    // Encrypt password
    $voluntarios = Voluntarios::all();
    foreach ($voluntarios as $key => $voluntario) {
        //echo($user->Username . ' - '.$user->Password. '<br>');
        $voluntario->FechaFinCertificado =  $voluntario->FechaFin;
        $voluntario->save();
        //dd($user);
    }
})->name('sss');

Route::get('per','Api\Voluntarios\VoluntariosApiController@obtenerDepartamentos')->name('per');



Route::get('f',function () {
    // Encrypt password
    allows_permission('crear_voluntarios');
})->name('f');