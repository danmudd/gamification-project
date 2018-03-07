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

Route::get('/', function () {
    return redirect()->route('home');
});

$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UserController@index')->name('users.index')->middleware('permission:users.view');
//Route::get('/users/create', 'UserController@create')->name('users.create')->middleware('permission:users.create');
Route::post('/users', 'UserController@store')->name('users.store')->middleware('permission:users.create');
Route::get('/users/{user}', 'UserController@show')->name('users.show')->middleware('permission:users.view');
//Route::get('/users/{user}/edit', 'UserController@show')->name('users.edit')->middleware('permission:users.update');
Route::put('/users/{user}', 'UserController@update')->name('users.update')->middleware('permission:users.update');
Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy')->middleware('permission:users.destroy');

Route::get('/roles', 'RoleController@index')->name('roles.index')->middleware('permission:roles.view');
//Route::get('/roles/create', 'RoleController@create')->name('roles.create')->middleware('permission:roles.create');
Route::post('/roles', 'RoleController@store')->name('roles.store')->middleware('permission:roles.create');
Route::get('/roles/{role}', 'RoleController@show')->name('roles.show')->middleware('permission:roles.view');
//Route::get('/roles/{role}/edit', 'RoleController@update')->name('roles.edit')->middleware('permission:roles.update');
Route::put('/roles/{role}', 'RoleController@update')->name('roles.update')->middleware('permission:roles.update');
Route::delete('/roles/{role}', 'RoleController@destroy')->name('roles.destroy')->middleware('permission:roles.destroy');
Route::post('/roles/{role}/permissions', 'RoleController@addPermission')->name('roles.permissions.add')->middleware('permission:roles.permissions.add');
Route::delete('/roles/{role}/permissions/{permission}', 'RoleController@removePermission')->name('roles.permissions.remove')->middleware('permission:roles.permissions.remove');
