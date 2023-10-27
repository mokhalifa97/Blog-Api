<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AuthController;
use App\Models\Articles;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('articles')->group(function(){
    Route::get('/',[ArticlesController::class,'index']);
    Route::get('/show/{id}',[ArticlesController::class,'show']);
    Route::post('/create',[ArticlesController::class,'create']);
    Route::post('/delete',[ArticlesController::class,'delete']);
    Route::post('/update',[ArticlesController::class,'update']);
});

Route::controller(AuthController::class)->group(function(){
    Route::post('login','login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});