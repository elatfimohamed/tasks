<?php

//index -> list
//store -> create
//delete -> destory
//edit -> PUT

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;

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
    Route::view('/contact', 'contact');

    Route::get('/tasks_vue', 'TasksVueController@index');
    Route::get('/tasques', 'TasquesController@index');
    Route::get('/home', 'TasquesController@index');


    // Fetes_propies
    Route::post('/taskscompleted/{task}', 'TasksCompletedController@store');
    Route::delete('/taskscompleted/{task}', 'TasksCompletedController@destroy');
    Route::get('/tasks', 'TasksController@index');
    Route::get('/', 'TasksController@index');
    // User tasks
    Route::get('/user/tasks', 'LoggedUserTasksController@index');

    Route::impersonate();


    //TAGS

    Route::get('/tags','TagsController@index');
});

Route::post('/login_alt', 'Auth\LoginAltController@login');
Route::post('/register_alt', 'Auth\RegisterAltController@store');

Route::get('/profile', '\\'. ProfileController::class . '@show');

Route::post('/photo', '\\'. PhotoController::class . '@store');

Route::get('/', function () {
    return view('welcome');


    });



//Auth::logout();
