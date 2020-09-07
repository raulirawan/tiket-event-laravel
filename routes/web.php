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


Route::get('/regencies', 'CountryController@regencies');
Route::get('/districts', 'CountryController@districts');
Route::get('/village', 'CountryController@villages');




Route::prefix('superadmin')
        ->namespace('superAdmin')
        ->group(function(){
            Route::get('/','DashboardController@index')->name('dashboard.superadmin');
            Route::resource('/user', 'UserController');
            Route::resource('/category', 'CategoryController');
            Route::resource('/event', 'EventController');
           
        }); 