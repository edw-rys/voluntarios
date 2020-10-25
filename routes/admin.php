<?php

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::namespace('Admin')->group( static function (){
    
    // Route::get('/', 'LoginController@view')->name('login.view');
    Route::middleware('redirect_dash')->get('login', 'LoginController@showLoginForm')->name('login.show');
    Route::middleware('redirect_dash')->post('login', 'LoginController@login')->name('login.post');
    Route::middleware(['SessionCheck'])->group(static function(){
        // Session logout
        Route::middleware(['SessionCheck'])->post('logout', 'LoginController@logout')->name('logout.post');
        // Required password change
            // Dashboard
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        // User profile
        //Route::get('profile', 'ClientController@index')->name('profile');
        // Invoices
        // Update Profile
        //Route::post('profile/update', 'ClientController@update')->name('profile.update');


        // Voluntarios
        // Route::get('profile/voluntariado', 'ClientController@update')->name('voluntariado');
        Route::namespace('Voluntarios')->group(function(){

            Route::get('evaluaciones_depa', 'VoluntariosController@update')->name('evaluaciones_depa');
            Route::get('voluntariado', 'VoluntariosController@update')->name('voluntariado');
            
            Route::group(['prefix' => 'evaluaciones'], function(){
                Route::get('', 'EvaluacionesController@index')->name('evaluaciones.index');
                Route::get('certificado/{id}', 'EvaluacionesController@reporteView')->name('evaluaciones.certificado');
                // Route::get('create', 'EvaluacionesController@index')->name('evaluaciones.create');
                Route::get('evaluar/{id}', 'EvaluacionesController@evaluateView')->name('evaluaciones.evaluate');
                Route::post('evaluar/evalua/{id}', 'EvaluacionesController@evaluate')->name('evaluaciones.evaluate.post');
            });

            Route::group(['prefix' => 'voluntarios'], function(){
                Route::get('', 'VoluntariosController@index')->name('voluntarios.index');
                Route::get('create', 'VoluntariosController@create')->name('voluntarios.create');
                Route::post('store', 'VoluntariosController@store')->name('voluntarios.store');
                Route::get('aprueba/{id}', 'VoluntariosController@certificadosView')->name('voluntarios.certificados');
                // Route::resource('voluntarios', 'VoluntariosController');
            });

            Route::group(['prefix' => 'certificados'], function(){
                Route::get('', 'CertificadosController@index')->name('certificados.index');
                Route::get('generar/evaluacion/{id}', 'CertificadosController@generarEvaluacion')->name('certificados.generar.evaluacion');
                Route::get('aprueba/{id}', 'CertificadosController@generaCertificadoAprobacion')->name('certificados.generar.certificado');

                // Route::get('create', 'VoluntariosController@create')->name('certificados.create');
            });
            
        });
    });
});