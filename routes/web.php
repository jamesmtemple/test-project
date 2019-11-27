<?php
    Route::view('/login','account.welcome')->name('login');

    Route::get('/login/init','Account\DiscordLoginController@redirect')->name('login.redirect');
    Route::get('/login/auth','Account\DiscordLoginController@auth')->name('login.auth');

    Route::middleware('auth')->group(function(){
        Route::get('/','Account\DashboardController@index')->name('home');

        Route::prefix('account')->name('account.')->namespace('Account')->group(function() {
            Route::get('settings','SettingsController@edit')->name('settings');

            Route::post('settings','SettingsController@update')->name('settings');
            Route::post('logout','DiscordLoginController@logout')->name('logout');
        });

        Route::namespace('System')->group(function() {
            Route::middleware('can:roles.manage')->resource('roles','RolesController');
            Route::middleware('can:departments.manage')->resource('departments','DepartmentsController');
            Route::middleware('can:divisions.manage')->resource('divisions','DivisionsController');
            Route::middleware('can:certs.manage')->resource('certifications','CertificationsController');
        });
    });
