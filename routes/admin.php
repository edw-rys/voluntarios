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
        Route::get('profile/ingreso', 'ClientController@update')->name('ingreso');
        Route::get('profile/voluntariado', 'ClientController@update')->name('voluntariado');
        Route::get('profile/evaluaciones', 'ClientController@update')->name('evaluaciones');
        Route::get('profile/voluntariado', 'ClientController@update')->name('voluntariado');
        Route::get('profile/evaluaciones_depa', 'ClientController@update')->name('evaluaciones_depa');
        
        Route::resource('voluntarios', 'VoluntariosController');

    });
    


});