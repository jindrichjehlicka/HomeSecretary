<?php

namespace Tests\Unit;

use HomeSecretary\Task;
use HomeSecretary\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssignTaskTest extends TestCase
{
    use WithoutMiddleware;

    public function testUserCanAssign()
    {
        $task = Task::first();
        $user = factory(User::class)->make([
            'password' => bcrypt('123456'),
        ]);

        $response = $this->from('/tasks/edit/' . $task->id)->put('/tasks/update/' . $task->id, [
            'assigned' => $user->id,
        ]);

        $this->asserTrue($response->success);

    }
}
