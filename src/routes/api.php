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


Route::post('/uploads/upload', 'Api\FileUploads@upload');
Route::get('/uploads/{uuid}/sharex-delete/{deltoken}', 'Api\FileUploads@sharexdelete')->name('sharex.delete');



Route::get('/source-query/all', 'Api\SourceQueryApi@GetAll')->middleware('ApiKey');
Route::get('/source-query/info', 'Api\SourceQueryApi@Info')->middleware('ApiKey');
Route::get('/walrus/facts', 'Api\Walrus@Facts')->middleware('ApiKey');
Route::post('/github/webhook', 'Api\Github@Webhook');

// MC API
Route::get('/mc/servers', 'Api\McClient@getServers');
Route::get('/mc/players', 'Api\McClient@getPlayers');
Route::get('/mc/servers/{slug}', 'Api\McClient@getServer');
Route::get('/mc/players/{username}', 'Api\McClient@getPlayer');
Route::get('/mc/players/{username}/stats/{slug}', 'Api\McClient@getStats');


Route::post('/mc/stats/{id}', 'Api\McServer@saveStats');
