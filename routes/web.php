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

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::get('/applyforcredit', 'ShipCreditApplicationController@apply');
Route::post('/applyforcredit/submit', 'ShipCreditApplicationController@store');

Route::get('/ship', 'ShipmentsController@create');
Route::get('/ship/admin', 'ShipmentsController@index')->middleware(['auth', 'auth.admin']);
Route::get('/ship/admin/edit/{id}', 'ShipmentsController@edit')->middleware(['auth', 'auth.admin']);
Route::put('/ship/admin/update/{id}', 'ShipmentsController@update')->middleware(['auth', 'auth.admin']);
Route::post('/ship', 'ShipmentsController@store');
Route::post('/ship/calc', 'ShipmentsController@calc');
Route::get('/ship/{id}', 'ShipmentsController@show');
Route::delete('/ship/{id}', 'ShipmentsController@destroy');

Route::get('/applyforstoragecredit', 'StorCreditApplicationController@apply');
Route::post('/applyforstoragecredit/submit', 'StorCreditApplicationController@store');

Route::get('/stor', 'StorageController@create');
Route::get('/stor/admin', 'StorageWorkController@index')->middleware(['auth', 'auth.admin']);
Route::get('/stor/admin/edit/{id}', 'StorageWorkController@edit')->middleware(['auth', 'auth.admin']);
Route::put('/stor/admin/update/{id}', 'StorageWorkController@update')->middleware(['auth', 'auth.admin']);
Route::get('/stor/addinventory', 'StorageWorkController@addinventory');
Route::get('/stor/transout', 'StorageWorkController@transoutInventory');
Route::get('/stor/{id}', 'StorageWorkController@show');
Route::delete('/stor/{id}', 'StorageWorkController@destroy');
Route::post('/stor/submittransout', 'StorageWorkController@storeTransOutInventory');
Route::post('/stor/submitinventory', 'StorageWorkController@store');
Route::post('/stor/calc', 'StorageController@calc');



Route::get('/fil', 'FulfillmentsController@create');
Route::get('/fil/admin', 'FulfillmentsController@index')->middleware(['auth', 'auth.admin']);
Route::post('/fil/submitrequest', 'FulfillmentRequestsController@store');



Route::get('/contact', 'ContactFormController@create');
Route::post('/contact', 'ContactFormController@store');

Route::resource('posts', 'PostsController');

Auth::routes(['verify' =>true]);

// The part that is commented out allows us to force the user to verify their email address
Route::get('/dashboard', 'DashboardController@index')->middleware('verified');

Route::get('/admin', function(){
    return 'You are an admin';
})->middleware(['auth', 'auth.admin']);


Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'auth.admin'])->name('admin.')->group(function(){
    Route::resource('/users', 'UserController', ['except' => ['show', 'create', 'store']]);
    Route::get('/impersonate/user/{id}', 'ImpersonateController@index')->name('impersonate');

});

Route::get('/Admin/impersonate/destroy', 'Admin\ImpersonateController@destroy')->name('admin.impersonate.destroy');

Auth::routes();
