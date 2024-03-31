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

        $response->assertViewIs('task.index');
        $response->assertStatus(200);
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

        $user = new User();
        $user->name = 'Test User';
        $user->role = User::ROLE_USER;
        $user->save();

        $admin = new User();
        $admin->name = 'Test Admin';
        $admin->role = User::ROLE_ADMIN;
        $admin->save();

        $task = new Task();
        $task->title = 'Test Task';
        $task->description = 'Test Description';
        $task->assigned_to_id = $user->id;
        $task->created_by_id = $admin->id;
        $task->save();

        $response = $this->post('/task/store', $task->toArray());

        $response->assertRedirect('/');

        Queue::assertPushed(UpdateStatisticsJob::class, function ($job) use ($user) {
            return $job->assigned_to_id === $user->id;
        });
    }

    public function testStatistics()
    {
        $response = $this->get('/statistics');

        $response->assertStatus(200);
        $response->assertViewIs('task.statistics');
    }
}
