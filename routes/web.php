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

//option place
Route::get('/regencies', 'CountryController@regencies');
Route::get('/districts', 'CountryController@districts');
Route::get('/village', 'CountryController@villages');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/category', 'CategoryController@index')->name('category');
Route::get('/category/{slug}', 'CategoryController@detail')->name('category-detail');
Route::get('/event', 'EventController@index')->name('event');
Route::get('/event/detail/{id}', 'EventController@detail')->name('event-detail');
Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/success', 'CartController@success')->name('success');


Route::prefix('admin')
        ->namespace('Admin')
        ->middleware(['auth','admin'])
        ->group(function(){
            Route::get('/','DashboardController@index')->name('dashboard.admin');
            
            Route::get('/event', 'EventAdminController@index')->name('event.admin.index');
            Route::get('/event/create', 'EventAdminController@create')->name('event.admin.create');
            Route::post('/event', 'EventAdminController@store')->name('event.admin.store');
            Route::get('/event/{event}', 'EventAdminController@show')->name('event.admin.show');
            Route::get('/event/{event}/edit', 'EventAdminController@edit')->name('event.admin.edit');
            Route::put('/event/{event}', 'EventAdminController@update')->name('event.admin.update');
            Route::delete('/event/{event}', 'EventAdminController@destroy')->name('event.admin.destroy');


            Route::post('/event/upload/gallery', 'EventAdminController@uploadGallery')->name('event.admin.upload.gallery');
            Route::get('/event/delete/gallery/{event}', 'EventAdminController@deleteGallery')->name('event.admin.delete.gallery');


            Route::get('/event/index/{event}', 'EventAdminController@indexEvent')->name('event.admin.index.event');
            Route::get('/event/create/user/{id}', 'EventAdminController@createEventUser')->name('event.admin.create.user');
            Route::post('/event/user/{id}', 'EventAdminController@createEventUserStore')->name('event.admin.user.store');
            Route::get('/event/user/{id}/edit', 'EventAdminController@eventUserEdit')->name('event.admin.user.edit');
            Route::put('/event/user/{id}', 'EventAdminController@eventUserUpdate')->name('event.admin.user.update');

            Route::get('/event/user/{id}', 'EventAdminController@eventUserDetail')->name('event.admin.user.detail');
            Route::delete('/event/index/{event}', 'EventAdminController@destroyUser')->name('event.admin.user.destroy');

            //event index


        }); 


Route::prefix('superadmin')
        ->namespace('superAdmin')
        ->middleware(['auth','superadmin'])
        ->group(function(){
            Route::get('/','DashboardController@index')->name('dashboard.superadmin');
            Route::resource('/user', 'UserController');
            Route::resource('/category', 'CategoryController');
            Route::resource('/event', 'EventController');
            Route::resource('/event-gallery', 'EventGalleryController');
            Route::resource('/transaction', 'TransactionController');
           
        }); 

Auth::routes();

