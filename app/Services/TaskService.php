<?php
namespace App\Services;

use App\Jobs\UpdateStatisticsJob;
use App\Models\Statistics;
use App\Models\Task;

class TaskService
{
    public static function storeTask($data){
        $task = Task::create($data);
        UpdateStatisticsJob::dispatch($task->assigned_to_id);
    }

    public static function getStatistics(){
        return Statistics::orderBy('tasks_count', 'desc')->take(10)->get();
    }
}