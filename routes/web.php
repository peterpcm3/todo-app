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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', 'Auth\RegisterController@registerForm')->name('auth.registerForm');

    Route::post('/register', 'Auth\RegisterController@register')->name('auth.register');

    Route::get('/', 'Auth\LoginController@loginForm')->name('auth.loginForm');

    Route::post('/', 'Auth\LoginController@login')->name('auth.login');
});

Route::group(['middleware' => 'auth'], function () {

    Route::post('/logout', 'Auth\LoginController@logout')->name('auth.logout');

    //Define routes for todos CRUD
    Route::get('/todo/list', 'Frontend\TodoController@index')->name('frontend.todo.list');
    Route::get('/todo/create', 'Frontend\TodoController@create')->name('frontend.todo.create');
    Route::post('/todo/createPost', 'Frontend\TodoController@createPost')->name('frontend.todo.createPost');
    Route::get('/todo/show/{id}', 'Frontend\TodoController@show')->name('frontend.todo.show');
    Route::get('/todo/edit/{id}', 'Frontend\TodoController@edit')->name('frontend.todo.edit');
    Route::put('/todo/updatePost/{id}', 'Frontend\TodoController@updatePost')->name('frontend.todo.updatePost');
    Route::delete('/todo/delete', 'Frontend\TodoController@delete')->name('frontend.todo.delete');
});
