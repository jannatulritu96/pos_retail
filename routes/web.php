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


Route::resource('company-settings', 'CompanySettingsController');
