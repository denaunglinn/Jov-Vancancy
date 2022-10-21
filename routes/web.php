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

Route::get('/','JobVacancyController@index')->name('home');
Route::name('job_vacancy.')
    ->prefix('job_vacancy')
    ->group(function(){
        Route::get('/datatable/ssd','JobVacancyController@ssd');
        Route::get('/details','JobVacancyController@show')->name('detail');
        Route::post('/store-application','JobVacancyController@storeApplication')->name('store-application');
});



