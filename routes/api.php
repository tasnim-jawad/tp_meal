<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => 'v1','namespace' => 'App\Http\Controllers\Auth', 'middleware' => 'guest:api'], function(){
    Route::group(['prefix' => '/user'] , function(){
        Route::post('/login', 'LoginController@login');
    });
});
Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function(){
    Route::get('user/check_user', [App\Http\Controllers\Auth\LoginController::class,'check_user']);
    Route::post('/api-logout', [App\Http\Controllers\Auth\LoginController::class,'logout']);

    Route::group(['prefix' => 'users'], function(){
        Route::get('', [App\Http\Controllers\User\UserController::class,'index']);
        Route::post('store', [App\Http\Controllers\User\UserController::class,'store']);
        Route::post('update/{id}', [App\Http\Controllers\User\UserController::class,'update']);
        Route::post('soft-delete', [App\Http\Controllers\User\UserController::class,'soft_delete']);
        Route::delete('destroy/{slug}', [App\Http\Controllers\User\UserController::class,'destroy']);
        Route::post('restore', [App\Http\Controllers\User\UserController::class,'restore']);
        Route::post('import', [App\Http\Controllers\User\UserController::class,'import']);
        Route::post('bulk-action', [App\Http\Controllers\User\UserController::class, 'bulkAction']);
        Route::get('{slug}', [App\Http\Controllers\User\UserController::class,'show']);
    });

    
});




