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
Route::post('/users', 'UserController@store')->name('users.store')->middleware('permission:users.create');
Route::get('/users/{user}', 'UserController@show')->name('users.show')->middleware('permission:users.view');
Route::put('/users/{user}', 'UserController@update')->name('users.update')->middleware('permission:users.update');
Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy')->middleware('permission:users.destroy');

Route::get('/roles', 'RoleController@index')->name('roles.index')->middleware('permission:roles.view');
Route::post('/roles', 'RoleController@store')->name('roles.store')->middleware('permission:roles.create');
Route::get('/roles/{role}', 'RoleController@show')->name('roles.show')->middleware('permission:roles.view');
Route::put('/roles/{role}', 'RoleController@update')->name('roles.update')->middleware('permission:roles.update');
Route::delete('/roles/{role}', 'RoleController@destroy')->name('roles.destroy')->middleware('permission:roles.destroy');
Route::post('/roles/{role}/permissions', 'RoleController@addPermission')->name('roles.permissions.add')->middleware('permission:roles.permissions.add');
Route::delete('/roles/{role}/permissions/{permission}', 'RoleController@removePermission')->name('roles.permissions.remove')->middleware('permission:roles.permissions.remove');

Route::get('/modules', 'ModuleController@index')->name('modules.index')->middleware('permission:modules.view');
Route::post('/modules', 'ModuleController@store')->name('modules.store')->middleware('permission:modules.create');
Route::get('/modules/{module}', 'ModuleController@show')->name('modules.show')->middleware('permission:modules.view');
Route::put('/modules/{module}', 'ModuleController@update')->name('modules.update')->middleware('permission:modules.update');
Route::delete('/modules/{module}', 'ModuleController@destroy')->name('modules.destroy')->middleware('permission:modules.destroy');
Route::post('/modules/{module}/users', 'ModuleController@addUser')->name('modules.users.add')->middleware('permission:modules.users.add');
Route::delete('/modules/{module}/users/{user}', 'ModuleController@removeUser')->name('modules.users.remove')->middleware('permission:modules.users.remove');

Route::get('/works', 'WorkController@index')->name('works.index')->middleware('permission:works.view');
Route::post('/works', 'WorkController@store')->name('works.store')->middleware('permission:works.create');
Route::get('/works/{work}', 'WorkController@show')->name('works.show')->middleware('permission:works.view');
Route::put('/works/{work}', 'WorkController@update')->name('works.update')->middleware('permission:works.update');
Route::delete('/works/{module}', 'WorkController@destroy')->name('works.destroy')->middleware('permission:works.destroy');

Route::get('/works/{work}/attachments/{attachment}', 'AttachmentController@show')->name('works.attachments.show')->middleware('permission:works.attachments.view');
Route::post('/works/{work}/attachments', 'AttachmentController@store')->name('works.attachments.store')->middleware('permission:works.attachments.create');
Route::delete('/works/{work}/attachments/{attachment}', 'AttachmentController@destroy')->name('works.attachments.destroy')->middleware('permission:works.attachments.destroy');
