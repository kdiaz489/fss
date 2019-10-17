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

Route::get('/termsofuse', 'SupportController@termsofuse');
Route::get('/privacypolicy', 'SupportController@privacypolicy');
Route::get('/returnpolicy', 'SupportController@returnpolicy');

Route::get('/applyforcredit', 'CreditApplicationController@apply');
Route::post('/applyforshipcredit/submit', 'CreditApplicationController@shipcreditsubmit');
Route::post('/applyforstorcredit/submit', 'CreditApplicationController@storcreditsubmit');
Route::get('/ship', 'ShipmentsController@create');
Route::get('/ship/request', 'ShipmentsController@requestshipment');
Route::get('/ship/book', 'ShipmentsController@bookshipment');
Route::get('/ship/admin', 'ShipmentsController@index')->middleware(['auth', 'auth.admin']);
Route::get('/ship/admin/edit/{id}', 'ShipmentsController@edit')->middleware(['auth', 'auth.admin']);
Route::put('/ship/admin/update/{id}', 'ShipmentsController@update')->middleware(['auth', 'auth.admin']);
Route::post('/submitshipment', 'ShipmentsController@store');
Route::post('/ship/calc', 'ShipmentsController@calc');
Route::get('/ship/{id}', 'ShipmentsController@show');
Route::delete('/ship/{id}', 'ShipmentsController@destroy');
Route::put('/ship/cancel/{id}', 'ShipmentsController@cancelrequest');
Route::get('/pdf/{id}', 'ShipmentsController@pdfexport');


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
Route::put('/stor/remove/{id}', 'StorageWorkController@removeinventory');
Route::post('/stor/calc', 'StorageController@calc');

Route::get('/stor/user/show/{id}', 'StorageController@show');
Route::get('/stor/product/edit/{id}', 'StorageController@edit')->middleware(['auth', 'auth.admin']);
Route::put('/stor/product/update/{id}', 'StorageController@update')->middleware(['auth', 'auth.admin']);



Route::get('/fil', 'FulfillmentsController@create');
Route::get('/fil/admin', 'FulfillmentsController@index')->middleware(['auth', 'auth.admin']);
Route::post('/fil/submitrequest', 'FulfillmentRequestsController@store');



Route::get('/contact', 'ContactFormController@create');
Route::post('/contact', 'ContactFormController@store');

Route::get('/basicunit', 'BasicUnitsController@create');
Route::post('/basicunit', 'BasicUnitsController@store');
Route::get('/viewbasicunit/{id}', 'BasicUnitsController@show');
Route::delete('/removebasicunit/{id}', 'BasicUnitsController@destroy');
Route::get('/editbasicunit/{id}', 'BasicUnitsController@edit');
Route::put('/updatebasicunit/{id}', 'BasicUnitsController@update');

Route::get('/createkit', 'KitsController@create');
Route::get('/viewkit/{id}', 'KitsController@show');
Route::post('createkit', 'KitsController@store');
Route::delete('/removekit/{id}', 'KitsController@destroy');
Route::get('/editkit/{id}', 'KitsController@edit');
Route::put('/editkit/{id}', 'KitsController@update');


Route::get('/transinkit', 'OrdersController@create');
Route::get('/vieworder/{id}', 'OrdersController@show');
Route::get('/transoutkit', 'OrdersController@create_transout_kit');
Route::get('/transoutunit', 'OrdersController@create_transout_unit');
Route::post('/transinkit', 'OrdersController@store');
Route::post('/transoutkit', 'OrdersController@store_transout_kit');
Route::post('/transoutunit', 'OrdersController@store_transout_unit');
Route::delete('/order/remove/{id}', 'OrdersController@destroy');
Route::get('/editorder/kit/{id}', 'OrdersController@edit');
Route::put('/updateorder/kit/{id}', 'OrdersController@update');
Route::get('/transinunit', 'OrdersController@create_unit_order');
Route::post('/transinunit', 'OrdersController@store_unit_order');
Route::get('/editorder/unit/{id}', 'OrdersController@edit_unit_order');
Route::put('/updateorder/unit/{id}', 'OrdersController@update_unit_order');


Route::resource('posts', 'PostsController');

Auth::routes(['verify' =>true]);

// The part that is commented out allows us to force the user to verify their email address
Route::get('/dashboard', 'DashboardController@index')/*->middleware('verified')*/;
Route::get('/updateusername', 'DashboardController@getupdateusername');
Route::get('/updateemail', 'DashboardController@getupdateemail');
Route::get('/updatepass', 'DashboardController@getupdatepass');
Route::get('/updatecompanyname', 'DashboardController@getupdatecompanyname');
Route::get('/updatecontactname', 'DashboardController@getupdatecontactname');
Route::get('/updateaddress', 'DashboardController@getupdateaddress');
Route::get('/adduser', 'DashboardController@getadduser');
Route::post('/submitupdateusername', 'DashboardController@updateusername');
Route::post('/submitupdateemail', 'DashboardController@updateemail');
Route::post('/submitupdatecompanyname', 'DashboardController@updatecompanyname');
Route::post('/submitupdatecontactname', 'DashboardController@updatecontactname');
Route::post('/submitupdateaddress', 'DashboardController@updateaddress');

Route::get('/boltemplate', 'PDFController@index');

Route::get('/checkout', 'AuthorizeController@index');
Route::post('/checkout', 'AuthorizeController@chargeCreditCard');

Route::get('/admin', function(){
    return 'You are an admin';
})->middleware(['auth', 'auth.admin']);


Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'auth.admin'])->name('admin.')->group(function(){
    Route::resource('/users', 'UserController', ['except' => ['show', 'create', 'store']]);
    Route::get('/impersonate/user/{id}', 'ImpersonateController@index')->name('impersonate');


});
Route::put('/user/credit/update/{id}', 'Admin\UserController@creditupdate');
Route::get('/Admin/impersonate/destroy', 'Admin\ImpersonateController@destroy')->name('admin.impersonate.destroy');

Auth::routes();
