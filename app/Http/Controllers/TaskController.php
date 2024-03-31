<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateStatisticsJob;
use App\Models\Statistics;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use App\Services\UserService;
use Illuminate\Http\Request;

class TaskController extends Controller 
{
    public function index(){
        $tasks = Task::paginate(10);
        $total_pages = $tasks->lastPage();

        return view('task.index', compact('tasks', 'total_pages')); 
    }

    public function create(){
        $admins = UserService::getAllAdmins();
        $users = UserService::getAllUsers();
        return view('task.create', compact('admins', 'users'));
    }

    public function store(Request $request){
        //ToDo replace Request with CreateTaskRequest requset->all() with request->validated()

        TaskService::storeTask($request->all());
        return redirect()->route('task.index');
    }

    public function statistics(){
        $top_users_tasks = TaskService::getStatistics();

        return view('task.statistics', compact('top_users_tasks'));
    }


}
