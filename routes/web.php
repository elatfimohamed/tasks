<?php

//index -> list
//store -> create
//delete -> destory
//edit -> PUT

Auth::routes();

// MIDDLEWARE

// GRUP DE URLS PER USUARIS AUTENTICATS

Route::middleware(['auth'])->group(function () {
    Route::post('/tasks', 'TasksController@store');
    Route::delete('/tasks/{id}', 'TasksController@destroy');
    Route::put('/tasks/{id}', 'TasksController@update');
    Route::get('/task_edit/{id}', 'TasksController@edit');

    Route::get('/about', function () {
        return view('about');
    });

    Route::view('/calendari', 'calendari');
    Route::get('/tasques', 'TasquesController@index');
    Route::get('/tasks_vue', 'TasksVueController@index');
    Route::get('/home', 'TasksVueController@index');

// Propies
    Route::post('/taskscompleted/{task}', 'TasksCompletedController@store');
    Route::delete('/taskscompleted/{task}', 'TasksCompletedController@destroy');

});
Route::get('/tasks', 'TasksController@index');
Route::get('/', 'TasksController@index');
// TODO
Route::post('/login_alt', 'Auth\LoginAltController@login');
Route::post('/register_alt', 'Auth\RegisterAltController@store');
//
////
//Route::get('/', function () {
//    return view('welcome');
//});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
