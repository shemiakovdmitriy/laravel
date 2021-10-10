<?php

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

Auth::routes();
//лаба 11
Route::get('/mainApi', 'IndexController@MainApi');
Route::post('/mainApi','IndexController@ShowCourse')->name('showCourse');

//лаба 10
Route::get('/', 'IndexController@MainPage');
Route::get('/main', 'IndexController@Main');
Route::get('/admin', 'IndexController@MainPage');
Route::get('/new', 'IndexController@NewCourse');
Route::post('/new', 'IndexController@Post')->name('post');
Route::get('/allCourses', 'IndexController@AdminAllCourses');
Route::get('/apartment', 'IndexController@Apartment')->name('Apartment');
Route::post('/sorted', 'IndexController@Sort')->name('sort');
Route::get('/course/{id}', 'IndexController@Course')->name('course');
Route::get('/subscribe/{Id}/{Name}', 'IndexController@Subscribe')->name('subscribe');
Route::post('/subscribe/{Id}', 'IndexController@SubscribeEnd')->name('subscribeEnd');
Route::get('/delete/{id}','IndexController@Delete')->name('delete');
Route::get('/deleteC/{courseId}/{userId}','IndexController@DeleteC')->name('deleteC');
Route::get('/home', 'HomeController@index')->name('home');
