<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SteamLoginController;
use kanalumaddela\LaravelSteamLogin\Facades\SteamLogin;
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

;


Route::get('/', 'PagesController@index');
Route::get('/home', 'PagesController@index')->name('pages.index');
Route::get('/mc', 'McStatusController@index')->name('pages.mc');
Route::get('/mc/log', 'McStatusController@log')->name('pages.mc.log');
Route::get('/projects',function (){
    return view("errors.wip");
})->name("pages.projects");

Route::post('/contact/send', 'ContactController@send')->name('contact.send');

//Auth
Route::get('/login', 'Auth\SteamLoginController@login')->name('login');
Route::get('auth/steam', 'Auth\SteamLoginController@authenticate')->name('auth.steam');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

//Manage
Route::group(['middleware' => ['can:Manage.See']], function () {
    Route::group(['middleware' => ['can:Roles.See']], function () {
        Route::resource('/manage/roles', 'Manage\RolesController');
    });

    Route::group(['middleware' => ['can:Alerts.See']], function () {
        Route::get('/manage/alerts', 'Manage\AlertsController@index')->name('alerts.index');
        Route::post('/manage/alerts', 'Manage\AlertsController@store')->name('alerts.store');
        Route::get('/manage/alerts/create', 'Manage\AlertsController@create')->name('alerts.create');
    });

    Route::group(['middleware' => ['can:Api.See']], function () {
        Route::resource('/manage/api', 'Manage\ApiKeysController');
    });

    Route::resource('/manage/permissions', 'Manage\PermissionsController');
    Route::get('/manage', 'Manage\ManageController@index')->name('manage.index');
});










