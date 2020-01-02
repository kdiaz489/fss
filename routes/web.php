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
Route::put('/updatekit/{id}', 'KitsController@update');


Route::get('/createcarton', 'CartonsController@create');
Route::post('/createcarton', 'CartonsController@store');
Route::get('/viewcarton/{id}', 'CartonsController@show');
Route::delete('/removecarton/{id}', 'CartonsController@destroy');
Route::get('/editcarton/{id}', 'CartonsController@edit');
Route::put('/updatecarton/{id}', 'CartonsController@update');

Route::get('/createpallet', 'PalletsController@create');
Route::post('/createpallet', 'PalletsController@store');
Route::get('/viewpallet/{id}', 'PalletsController@show');
Route::delete('/removepallet/{id}', 'PalletsController@destroy');
Route::get('/editpallet/{id}', 'PalletsController@edit');
Route::put('/updatepallet/{id}', 'PalletsController@update');


Route::get('/vieworder/{id}', 'OrdersController@show');
Route::delete('/order/remove/{id}', 'OrdersController@destroy');
Route::put('/order/update/{id}', 'OrdersController@updatestatus');
Route::get('/createtransin', 'OrdersController@create_transin_order');
Route::post('/createtransin', 'OrdersController@store_transin_order');
Route::get('/createtransout', 'OrdersController@create_transout_order');
Route::post('/createtransout', 'OrdersController@store_transout_order');
Route::get('/createfilorder', 'OrdersController@create_fil_order');
Route::post('/createfilorder', 'OrdersController@store_fil_order');
Route::post('/verifyorderskus/{id}', 'OrdersController@verify_order_skus');

Route::resource('posts', 'PostsController');

Auth::routes(['verify' =>true]);

// The part that is commented out allows us to force the user to verify their email address
Route::get('/dashboard', 'DashboardController@index')->middleware('verified');
//Route::get('/dashboard', 'DashboardController@index')->middleware('auth');
Route::get('/dashboard/user/inventory', 'DashboardController@getuserdashinventory');
Route::get('/dashboard/user/account', 'DashboardController@getuserdashaccount');
Route::get('/dashboard/user/orders', 'DashboardController@getuserorders');
Route::get('/dashboard/user/fulfillment', 'DashboardController@getuserdashfulfillment');
Route::get('/dashboard/user/getquote', 'DashboardController@getusershippingquote');
Route::get('/dashboard/user/bookshipment', 'DashboardController@getuserbookshipment');

Route::get('/dash/test', 'DashboardController@getdashhome');


Route::get('/dashboard/admin/users', 'DashboardController@getadminusers');
Route::get('/dashboard/admin/fulfillment', 'DashboardController@getadminfulfillment');
Route::get('/dashboard/admin/orders', 'DashboardController@getadminorders');
Route::get('/dashboard/admin/inventory', 'DashboardController@getadmininventory');
Route::get('/dashboard/admin/account', 'DashboardController@getadminaccount');
Route::get('/dashboard/admin/fulfill/{id}', 'DashboardController@getadminfulfillorderform');


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
Route::get('/makepayment/{id}', 'AuthorizeController@makepaymentform');
Route::post('/makeapayment', 'AuthorizeController@makepayment');

Route::get('/createcase', 'CasesController@create');
Route::get('/viewcase/{id}', 'CasesController@show');
Route::post('/createcase', 'CasesController@store');
Route::get('editcase/{id}', 'CasesController@edit');
Route::put('/updatecase/{id}', 'CasesController@update');
Route::delete('/removecase/{id}', 'CasesController@destroy');


Route::get('/getallproducts', 'ShopifyController@index');
Route::get('/scanshopifyorders', 'ShopifyController@scanOrders');

Route::post('csv_file/import', 'CsvFile@csv_import')->name('import');
Route::get('csv_file/export', 'CsvFile@csv_export')->name('export');
Route::get('/order/export/{id}', 'CsvFile@order_export')->name('orderexport');
Route::get('/inventory/export/{id}', 'CsvFile@inventory_export')->name('inventoryexport');
Route::get('/inventory/kits/export/{id}', 'CsvFile@kits_export')->name('kitsexport');
Route::get('/inventory/cases/export/{id}', 'CsvFile@cases_export')->name('casesexport');
Route::get('/inventory/cartons/export/{id}', 'CsvFile@cartons_export')->name('cartonsexport');

Route::get('/admin', function(){
    return 'You are an admin';
})->middleware(['auth', 'auth.admin']);


Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'auth.admin'])->name('admin.')->group(function(){
    Route::resource('/users', 'UserController', ['except' => ['show', 'create', 'store']]);
    Route::get('/impersonate/user/{id}', 'ImpersonateController@index')->name('impersonate');


});
Route::put('/user/credit/update/{id}', 'Admin\UserController@creditupdate');
Route::put('/user/accbal/update/{id}', 'Admin\UserController@accountbalanceupdate');
Route::get('/Admin/impersonate/destroy', 'Admin\ImpersonateController@destroy')->name('admin.impersonate.destroy');

Auth::routes();
