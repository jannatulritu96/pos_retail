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
    Route::resource('outlet', 'Settings\OutletController');
    Route::resource('customer', 'Settings\CustomerController');
    Route::resource('payment', 'Settings\PaymentController');
    Route::resource('supplier', 'Settings\CompanySettingsController');
    Route::resource('unit', 'Settings\UnitController');
});
