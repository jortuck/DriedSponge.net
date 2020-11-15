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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/source-query/all', 'Api\SourceQueryApi@GetAll')->middleware('ApiKey');
Route::get('/source-query/info', 'Api\SourceQueryApi@Info')->middleware('ApiKey');
Route::get('/walrus/facts', 'Api\Walrus@Facts')->middleware('ApiKey');
Route::post('/github/webhook', 'Api\Github@Webhook');
Route::post('/test/post',function (){
    sleep(3);
    return response()->json(["test"=>"test","test2"=>"test2"]);
});

