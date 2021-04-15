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

//Load More
Route::post('load-more-data','HomeController@loadMore')->name('load-more-data');

Route::get('/check-ticket', 'HomeController@checkTicket')->name('check.ticket');
Route::get('/category', 'CategoryController@index')->name('category');
Route::get('/category/{slug}', 'CategoryController@detail')->name('category-detail');
Route::get('/event', 'EventController@index')->name('event');
Route::get('/event/detail/{id}', 'EventController@detail')->name('event-detail');



Route::group(['middleware' => ['auth','user']], function () {

        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('/transaction', 'DashboardController@transaction')->name('transaction');

        Route::post('/event/detail/{id}', 'EventController@addTicket')->name('add-ticket');
        Route::get('/cart', 'CartController@index')->name('cart');
        Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');

        Route::get('/profile', 'ProfileController@index')->name('profile.index');
        Route::post('/profile', 'ProfileController@update')->name('profile.update');

        Route::get('/change-password', 'ProfileController@changePassword')->name('change.password');
        Route::post('/change-password', 'ProfileController@changePasswordUpdate')->name('change.password.udpate');


        Route::post('/checkout', 'CheckoutController@checkout')->name('checkout');
        Route::get('/success', 'CartController@success')->name('success');

   
});


Route::prefix('admin')
        ->namespace('Admin')
        ->middleware(['auth', 'admin'])
        ->group(function () {
                Route::get('/', 'DashboardController@index')->name('dashboard.admin');


                Route::get('/event', 'EventAdminController@index')->name('event.admin.index');
                Route::get('/event/create', 'EventAdminController@create')->name('event.admin.create');
                Route::post('/event', 'EventAdminController@store')->name('event.admin.store');

                Route::get('transaction', 'TransactionController@index')->name('transaction.admin.index');

                Route::get('/event/{event}', 'EventAdminController@show')->name('event.admin.show');
                Route::get('/event/{event}/edit', 'EventAdminController@edit')->name('event.admin.edit');
                Route::put('/event/{event}', 'EventAdminController@update')->name('event.admin.update');
                Route::delete('/event/{event}', 'EventAdminController@destroy')->name('event.admin.destroy');

                Route::get('transaction/{transaction}/edit', 'TransactionController@edit')->name('transaction.admin.edit');

                Route::put('transaction/{transaction}', 'TransactionController@update')->name('transaction.admin.update');
                Route::delete('transaction/{transaction}', 'TransactionController@destroy')->name('transaction.admin.destroy');


                Route::post('/event/upload/gallery', 'EventAdminController@uploadGallery')->name('event.admin.upload.gallery');
                Route::get('/event/delete/gallery/{event}', 'EventAdminController@deleteGallery')->name('event.admin.delete.gallery');

                //event index    
                Route::get('/event/index/{event}', 'EventAdminController@indexEvent')->name('event.admin.index.event');
                Route::get('/event/create/user/{id}', 'EventAdminController@createEventUser')->name('event.admin.create.user');
                Route::post('/event/user/{id}', 'EventAdminController@createEventUserStore')->name('event.admin.user.store');
                Route::get('/event/user/{id}/edit', 'EventAdminController@eventUserEdit')->name('event.admin.user.edit');
                Route::put('/event/user/{id}', 'EventAdminController@eventUserUpdate')->name('event.admin.user.update');

                Route::get('/event/user/{id}', 'EventAdminController@eventUserDetail')->name('event.admin.user.detail');
                Route::delete('/event/index/{event}', 'EventAdminController@destroyUser')->name('event.admin.user.destroy');

                //check in check out
                Route::get('/event/index/check-in/{event}', 'EventAdminController@indexEventCheckIn')->name('event.admin.index.event.check.in');
                Route::put('/event/index/check-in/{event}', 'EventAdminController@updateStatusCheckIn')->name('event.admin.index.event.update.check.in');

                Route::get('/event/index/check-out/{event}', 'EventAdminController@indexEventCheckOut')->name('event.admin.index.event.check.out');
                Route::put('/event/index/check-out/{event}', 'EventAdminController@updateStatusCheckOut')->name('event.admin.index.event.update.check.out');

                Route::get('/event/index/export/{event}', 'EventAdminController@exportExcel')->name('export-excel');
                //print tiket
                Route::get('/event/user/print/{id}', 'PrintController@printTiket')->name('print.tiket');
        });


Route::prefix('superadmin')
        ->namespace('superAdmin')
        ->middleware(['auth', 'superadmin'])
        ->group(function () {
                Route::get('/', 'DashboardController@index')->name('dashboard.superadmin');
                Route::resource('/user', 'UserController');
                Route::resource('/category', 'CategoryController');
                Route::resource('/event', 'EventController');

                Route::post('/event/upload/gallery', 'EventController@uploadGallery')->name('event.upload.gallery');
                Route::get('/event/delete/gallery/{event}', 'EventController@deleteGallery')->name('event.delete.gallery');


                Route::resource('/event-gallery', 'EventGalleryController');
                Route::resource('/transaction', 'TransactionController');
        });

Auth::routes(['verify' => true]);

// Midtrans

Route::post('midtrans/callback', 'MidtransController@notificationHandler');
Route::get('midtrans/finish', 'MidtransController@finishRedirect');
Route::get('midtrans/unfinish', 'MidtransController@unfinishRedirect');
Route::get('midtrans/error', 'MidtransController@errorRedirect');
