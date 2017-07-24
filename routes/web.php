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
    return view('home');
})->name('home');

Auth::routes();

Route::get('tasks', ['as'=> 'tasks_index', 'uses' => 'TaskController@index']);

Route::get('dicts', ['as' => 'dicts_index', 'uses' => 'DictController@index']);