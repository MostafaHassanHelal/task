<?php

namespace Tests\Unit;

use App\Jobs\UpdateStatisticsJob;
use App\Models\Task;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Queue;


class TaskTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/');
    
        // Check if the response is a view
        $response->assertViewIs('task.index');
    
        // Check if the response has a status code of 200
        $response->assertStatus(200);;
    }

    public function testCreate()
    {
        $response = $this->get('/task/create');

        $response->assertViewIs('task.create');
        $response->assertStatus(200);
    }

    public function testStore()
    {
        Queue::fake();

        $task = new Task();
        $task->title = 'Test Task';
        $task->description = 'Test Description';
        $task->assigned_to_id = 1;
        $task->created_by_id = 1114;
        $task->save();

        $response = $this->post('/task/store', $task->toArray());

        $response->assertRedirect('/');

        Queue::assertPushed(UpdateStatisticsJob::class, function ($job)  {
            return $job->assigned_to_id === 1;
        });
    }

    public function testStatistics()
    {
        $response = $this->get('/statistics');

        $response->assertStatus(200);
        $response->assertViewIs('task.statistics');
    }
}
