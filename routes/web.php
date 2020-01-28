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

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

// Change Password
Route::get('password-change', 'DashboardController@showResetForm')->name('password.change');
Route::post('password-update', 'DashboardController@updatepassword')->name('update.password');

Auth::routes([
    'register' => false,
]);

Route::get('dashboard','DashboardController@index')->name('dashboard');

Route::group(['prefix' => 'settings'], function (){

    Route::resource('company-settings', 'Settings\CompanySettingsController');
    //Outlet route
    Route::resource('outlet', 'Settings\OutletController');
    Route::post('/outlet/change-activity/{id}', 'Settings\OutletController@changeActivity')->name('outlet.change-activity');
    //Outlet route
    Route::resource('customer', 'Settings\CustomerController');
    Route::post('/customer/change-activity/{id}', 'Settings\CustomerController@changeActivity')->name('customer.change-activity');
    //Outlet route
    Route::resource('payment', 'Settings\PaymentController');
    Route::post('/payment/change-activity/{id}', 'Settings\PaymentController@changeActivity')->name('payment.change-activity');
    //Outlet route
    Route::resource('supplier', 'Settings\SupplierController');
    Route::post('/supplier/change-activity/{id}', 'Settings\SupplierController@changeActivity')->name('supplier.change-activity');
    //Outlet route
    Route::resource('unit', 'Settings\UnitController');
    Route::post('/unit/change-activity/{id}', 'Settings\UnitController@changeActivity')->name('unit.change-activity');
});
