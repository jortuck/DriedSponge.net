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

Route::domain(config('extra.image_domain'))->group(function () {
    Route::get('/file/{name}', 'FileUploads@loadFile')->name('upload.load-file');
    Route::get('/{uuid}', 'FileUploads@loadView')->name('upload.load-view');
});

Route::get('auth/steam', 'Auth\SteamLoginController@authenticate')->name('auth.steam');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::prefix('app')->group(function () {
    Route::get('/app/login', 'Auth\SteamLoginController@login')->name('login');
    Route::get('/user', 'Auth\User@me');
    Route::get('/user/can/{pname}', 'Auth\user@can');
    Route::post('/contact/send', 'ContactController@send')->name('contact.send');
    Route::get('/contact-form/get', 'Manage\Contact@index');
    Route::get('/contact-form/{id}', 'Manage\Contact@read');
    Route::delete('/contact-form/{id}', 'Manage\Contact@delete');
});


Route::get('/{any}', function(){
    return view('spa');
})->name('spa')->where('any', '.*');










