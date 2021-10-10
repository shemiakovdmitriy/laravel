<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('my_api', 'IndexController@my_api');
Route::get('show','IndexController@ShowApi');
Route::post('new', 'IndexController@NewApi'); 
Route::delete('delete', 'IndexController@DeleteApi');
Route::put('update','IndexController@Update');