<?php
namespace App\Http\Controllers;
use App\Http\Requests\UserTasquesIndex;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasquesController extends Controller
{
    public function index(UserTasquesIndex $request)
    {

        if (Auth::user()->can('tasks.manage')){
            $tasks = map_collection(Task::orderBy('created_at','desc') -> get());
            $uri = 'api/v1/tasks';
            $uri = 'api/v1/tasks/';
        }else {
            $tasks = map_collection($request->user()->tasks);
            $uri = 'api/v1/user/tasks';
            $uri = 'api/v1/user/tasks/';
        }
    }

}