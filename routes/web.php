<?php

//index -> list
//store -> create
//delete -> destory
//edit -> PUT

Route::get('/tasks', 'TasksController@index');
Route::get('/', function () {
    return view('welcome');
});
Route::post('/tasks', 'TasksController@store');
Route::delete('/tasks/{id}', 'TasksController@destroy');
Route::put('/tasks/{id}', 'TasksController@update');
Route::get('/task_edit/{id}', 'TasksController@edit');

Route::get('/about', function () {
    return view('about');
});

Route::view('/calendari', 'calendari');

Route::get('/tasks_vue', 'TasksVueController@index');
Route::get('/home','TasksVueController@index');

// Propies
Route::post('/taskscompleted/{task}', 'TasksCompletedController@store');
Route::delete('/taskscompleted/{task}', 'TasksCompletedController@destroy');

Auth::routes();

// TODO
Route::post('/login_alt','Auth\LoginAltController@login');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
