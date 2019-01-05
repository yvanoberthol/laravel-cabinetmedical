<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('specialites', 'SpecialiteController');
    Route::resource('medecinspecialites', 'MedecinSpecialiteController');
    Route::resource('creneaus', 'CreneauController');
    Route::resource('medecins', 'MedecinController');
    Route::get('/deleteMedecinSpecialite/{medecin}/{specialite}', 'MedecinController@suppSpecialite')->name('medecins.deleteMedecinSpecialite');
    Route::get('/statMedecinSpecialite', 'SpecialiteController@statMedecinSpecialite')->name('specialites.statMedecinSpecialite');
    Route::post('/addSpecialite', 'MedecinController@addSpecialite')->name('medecins.addSpecialite');
    Route::post('/changerPhoto', 'MedecinController@changerPhoto')->name('medecins.changerPhoto');
    Route::get('/medecinsBy', 'MedecinController@search')->name('medecins.searchBy');
    Route::get('/creneausBy', 'CreneauController@search')->name('creneaus.searchBy');
    Route::get('/chargement', 'HomeController@chargement')->name('home.chargement');
    Route::get('/menuPrincipal', 'HomeController@menu')->name('home.menu');
    Route::middleware(['is_superadmin'])->group(function (){
        Route::get('/formaddrole', 'UserController@formaddrole')->name('users.formaddrole');
        Route::get('/deleteUserRole/{user}/{role}', 'UserController@suppRole')->name('users.deleteUserRole');
        Route::post('/addrole', 'UserController@addRole')->name('users.addRole');
        Route::post('/activeUser', 'UserController@activeUser')->name('users.activeUser');
        Route::post('/desactiveUser', 'UserController@desactiveUser')->name('users.desactiveUser');
        Route::resource('users', 'UserController');
        Route::resource('userRoles', 'UserRoleController');
        Route::resource('roles', 'RoleController');
    });
});







