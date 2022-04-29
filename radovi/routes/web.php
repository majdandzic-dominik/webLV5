<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/edit_user/{id}', 'App\Http\Controllers\ThesesController@edit_user')->name('edit_user');
Route::put('/update_user/{id}', 'App\Http\Controllers\ThesesController@update_user')->name('update_user');

Route::get('/make_admin', 'App\Http\Controllers\ThesesController@make_admin')->name('make_admin');
Route::put('/confirm_make_admin', 'App\Http\Controllers\ThesesController@confirm_make_admin')->name('confirm_make_admin');

Route::get('/apply_thesis/{id}', 'App\Http\Controllers\ThesesController@apply_thesis')->name('apply_thesis');
Route::put('/confirm_thesis_application/{id}', 'App\Http\Controllers\ThesesController@confirm_thesis_application')->name('confirm_thesis_application');

Route::get('/delete_thesis_application/{id}', 'App\Http\Controllers\ThesesController@delete_thesis_application')->name('delete_thesis_application');
Route::put('/confirm_thesis_deletion/{id}', 'App\Http\Controllers\ThesesController@confirm_thesis_deletion')->name('confirm_thesis_deletion');

Route::resource('thesis', 'App\Http\Controllers\ThesesController');
