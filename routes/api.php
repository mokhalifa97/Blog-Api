<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
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

// all authors table api's
Route::group(['prefix'=>'authors'],function(){
    Route::get('/',[AuthorController::class,'index']);
    Route::get('/show/{id}',[AuthorController::class,'show']);
    Route::post('/delete',[AuthorController::class,'delete']);
});



// register and login to access all api's
Route::group(['prefix'=> 'auth'],function(){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::get('/test',[AuthController::class,'test']);
});

