<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_five_task_pages_load(): void
    {
        $task = Task::create([
            'title' => 'Prepare project plan',
            'status' => 'pending',
        ]);

        $this->get(route('dashboard'))->assertOk()->assertSee('Task dashboard');
        $this->get(route('tasks.index'))->assertOk()->assertSee($task->title);
        $this->get(route('tasks.create'))->assertOk()->assertSee('Create a task');
        $this->get(route('tasks.show', $task))->assertOk()->assertSee($task->title);
        $this->get(route('tasks.edit', $task))->assertOk()->assertSee('Edit task');
    }

    public function test_tasks_can_be_created_updated_and_deleted(): void
    {
        $this->post(route('tasks.store'), [
            'title' => 'Write documentation',
            'description' => 'Add the getting started guide.',
            'status' => 'in_progress',
            'due_date' => '2026-12-01',
        ])->assertRedirect(route('tasks.index'));

        $task = Task::firstOrFail();
        $this->assertSame('in_progress', $task->status);

        $this->put(route('tasks.update', $task), [
            'title' => 'Finish documentation',
            'description' => 'Complete the guide.',
            'status' => 'completed',
            'due_date' => null,
        ])->assertRedirect(route('tasks.show', $task));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Finish documentation',
            'status' => 'completed',
        ]);

        $this->delete(route('tasks.destroy', $task))
            ->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_task_title_is_required(): void
    {
        $this->from(route('tasks.create'))
            ->post(route('tasks.store'), [
                'title' => '',
                'status' => 'pending',
            ])
            ->assertSessionHasErrors('title');
    }
}
