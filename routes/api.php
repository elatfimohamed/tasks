<?php

use App\Http\Controllers\Api\GitController;
use App\Task;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:api'])->group(function () {
    // Tasks
    Route::get('/v1/tasks', 'Api\TasksController@index');
    Route::get('/v1/tasks/{task}', 'Api\TasksController@show');
    Route::delete('/v1/tasks/{task}', 'Api\TasksController@destroy');
    Route::post('/v1/tasks/', 'Api\TasksController@store');
    Route::put('/v1/tasks/{task}', 'Api\TasksController@update');



    // Tags
    Route::get('/v1/tags', 'Api\TagsController@index');
    Route::get('/v1/tags/{tag}', 'Api\TagsController@show');
    Route::delete('/v1/tags/{tag}', 'Api\TagsController@destroy');
    Route::post('/v1/tags/', 'Api\TagsController@store');
    Route::put('/v1/tags/{tag}', 'Api\TagsController@update');

    // Completed tasks
    Route::post('/v1/completed_task/{task}', 'Api\TasksCompletedController@store');
    Route::delete('/v1/completed_task/{task}', 'Api\TasksCompletedController@destroy');


    Route::get('/v1/user/tasks', 'Api\LoggedUserTasksController@index');
    Route::get('/v1/user/tasks/{task}', 'Api\LoggedUserTasksController@show');
    Route::post('/v1/user/tasks', 'Api\LoggedUserTasksController@store');
    Route::put('/v1/user/tasks/{task}', 'Api\LoggedUserTasksController@update');
    Route::delete('/v1/user/tasks/{task}', 'Api\LoggedUserTasksController@destroy');


    //Users
    Route::get('/v1/users','Api\UsersController@index');
    Route::get('/v1/regular_users','Api\RegularUsersController@index');


    Route::get('/v1/git/info','\\' . GitController::class . '@index');


});