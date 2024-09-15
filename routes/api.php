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

    Route::group(['prefix' => 'batches'], function(){
        Route::get('', [App\Http\Controllers\Admin\BatchController::class,'index']);
        Route::post('store', [App\Http\Controllers\Admin\BatchController::class,'store']);
        Route::post('update/{id}', [App\Http\Controllers\Admin\BatchController::class,'update']);
        Route::post('soft-delete', [App\Http\Controllers\Admin\BatchController::class,'soft_delete']);
        Route::delete('destroy/{slug}', [App\Http\Controllers\Admin\BatchController::class,'destroy']);
        Route::post('restore', [App\Http\Controllers\Admin\BatchController::class,'restore']);
        Route::post('import', [App\Http\Controllers\Admin\BatchController::class,'import']);
        Route::post('bulk-action', [App\Http\Controllers\Admin\BatchController::class, 'bulkAction']);
        Route::get('{slug}', [App\Http\Controllers\Admin\BatchController::class,'show']);
    });

    Route::group(['prefix' => 'settings'], function(){
        Route::get('', [App\Http\Controllers\Admin\SettingController::class,'index']);
        Route::post('store', [App\Http\Controllers\Admin\SettingController::class,'store']);
        Route::post('update/{id}', [App\Http\Controllers\Admin\SettingController::class,'update']);
        Route::post('soft-delete', [App\Http\Controllers\Admin\SettingController::class,'soft_delete']);
        Route::delete('destroy/{slug}', [App\Http\Controllers\Admin\SettingController::class,'destroy']);
        Route::post('restore', [App\Http\Controllers\Admin\SettingController::class,'restore']);
        Route::post('import', [App\Http\Controllers\Admin\SettingController::class,'import']);
        Route::post('bulk-action', [App\Http\Controllers\Admin\SettingController::class, 'bulkAction']);
        Route::get('{slug}', [App\Http\Controllers\Admin\SettingController::class,'show']);
    });

    Route::group(['prefix' => 'holidays'], function(){
        Route::get('', [App\Http\Controllers\Admin\HolidayController::class,'index']);
        Route::post('store', [App\Http\Controllers\Admin\HolidayController::class,'store']);
        Route::post('update/{id}', [App\Http\Controllers\Admin\HolidayController::class,'update']);
        Route::post('soft-delete', [App\Http\Controllers\Admin\HolidayController::class,'soft_delete']);
        Route::delete('destroy/{slug}', [App\Http\Controllers\Admin\HolidayController::class,'destroy']);
        Route::post('restore', [App\Http\Controllers\Admin\HolidayController::class,'restore']);
        Route::post('import', [App\Http\Controllers\Admin\HolidayController::class,'import']);
        Route::post('bulk-action', [App\Http\Controllers\Admin\HolidayController::class, 'bulkAction']);
        Route::get('{slug}', [App\Http\Controllers\Admin\HolidayController::class,'show']);
    });

    Route::group(['prefix' => 'daily-bajars'], function(){
        Route::get('date-wise-bajar', [App\Http\Controllers\Admin\Account\DailyBajarController::class,'date_wise_bajar']);
        Route::get('bajar-single-day', [App\Http\Controllers\Admin\Account\DailyBajarController::class,'bajar_single_day']);

        Route::post('store', [App\Http\Controllers\Admin\Account\DailyBajarController::class,'store']);
        Route::post('update/{id}', [App\Http\Controllers\Admin\Account\DailyBajarController::class,'update']);
        Route::post('soft-delete', [App\Http\Controllers\Admin\Account\DailyBajarController::class,'soft_delete']);
        Route::delete('destroy/{slug}', [App\Http\Controllers\Admin\Account\DailyBajarController::class,'destroy']);
        Route::post('restore', [App\Http\Controllers\Admin\Account\DailyBajarController::class,'restore']);
        Route::post('import', [App\Http\Controllers\Admin\Account\DailyBajarController::class,'import']);
        Route::post('bulk-action', [App\Http\Controllers\Admin\Account\DailyBajarController::class, 'bulkAction']);
        Route::get('{slug}', [App\Http\Controllers\Admin\Account\DailyBajarController::class,'show']);
    });

});




