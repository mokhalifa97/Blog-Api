<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// all articles table api's
Route::group(['prefix'=> 'articles' , 'middleware' => 'articleCheck'],function(){
    Route::get('/',[ArticlesController::class,'index']);
    Route::get('/show/{id}',[ArticlesController::class,'show']);
    Route::post('/create',[ArticlesController::class,'create']);
    Route::post('/delete',[ArticlesController::class,'delete']);
    Route::post('/update',[ArticlesController::class,'update']);
});



// register and login to access all api's
Route::group(['prefix'=> 'auth'],function(){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::get('/test',[AuthController::class,'test']);
});

