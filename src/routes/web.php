<?php

use Illuminate\Support\Facades\Route;
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
    Route::get('/{uuid}', 'FileUploads@loadView')->name('upload.load-view');
    Route::permanentRedirect('/g/{uuid}', "/{uuid}");
});

Route::post('/logout', function (){
    \Auth::logout();
})->name('logout');
Route::get('/logout', function (){
    \Auth::logout();
});

Route::prefix('app')->group(function () {

    Route::prefix('login')->group(function () {
        Route::get('/steam',function (){
            return Socialite::driver('steam')->redirect(); // Steam Login
        })->name('login.steam');
        Route::get('/discord',function (){
            return Socialite::driver('discord')->scopes(['connections'])->redirect(); // Discord Login
        })->name('login.discord');
        Route::get('/github',function (){
            return Socialite::driver('github')->redirect(); // github Login
        })->name('login.github');
        //Route::get('/login/google', function () {
        //    return Socialite::driver('google')->redirect(); //Google Login
        //})->name('login.google');
    });

    Route::prefix('auth')->group(function () {
        Route::get('/steam', 'Auth\SteamLoginController@auth')->name('auth.steam');
        Route::get('/discord', 'Auth\DiscordLoginController@auth')->name('auth.discord');
        Route::get('/github', 'Auth\GithubLoginController@auth')->name('auth.github');
        //Route::get('/auth/google', 'Auth\SteamLoginController@auth')->name('auth.google');
    });

    Route::get('/user',[App\Http\Controllers\Auth\User::class, 'me']);
    Route::get('/user/can/{pname}', 'Auth\user@can');
    Route::post('/contact/send', 'ContactController@send')->name('contact.send');


    Route::get('/manage/contact-form/', 'Manage\Contact@index');
    Route::get('/manage/contact-form/{id}', 'Manage\Contact@read');
    Route::delete('/manage/contact-form/{id}', 'Manage\Contact@delete');

    Route::get('/manage/alerts', 'Manage\AlertsController@index');
    Route::post('/manage/alerts', 'Manage\AlertsController@store');
    Route::delete('/manage/alerts/{id}', 'Manage\AlertsController@destroy');
    Route::get('/manage/alerts/{id}', 'Manage\AlertsController@show');
    Route::put('/manage/alerts/{id}', 'Manage\AlertsController@update');

    Route::get('/manage/files/{folder?}', 'Manage\FileUploads@files');


    Route::get('/manage/mc-servers', 'Manage\McServerController@index');
    Route::get('/manage/mc-servers/players', 'Manage\McServerController@players');
    Route::delete('/manage/mc-servers/players/{id}', 'Manage\McServerController@playerDelete');
    Route::post('/manage/mc-servers', 'Manage\McServerController@store');
    Route::delete('/manage/mc-servers/{id}', 'Manage\McServerController@destroy');
    Route::get('/manage/mc-servers/{id}', 'Manage\McServerController@show');
    Route::put('/manage/mc-servers/{id}', 'Manage\McServerController@update');
    Route::patch('/manage/mc-servers/{id}/key', 'Manage\McServerController@regen');

});


Route::get('/{any}', function(){
    return view('spa');
})->name('spa')->where('any', '.*');
